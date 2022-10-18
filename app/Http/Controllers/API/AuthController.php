<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Library\Structure;
use App\Library\Message;
use App\Library\Sms;
use App\Models\Secrete;
use App\Models\User;

class AuthController extends Controller
{
    // Structure of response API.
    use Structure;

    /**
     * User Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if (!$validator->fails()) {
            
            //Check user is register or not.
            $user_id = NULL;
            $user = User::where(['phone' => $request->phone])->first();
            if ($user) {
                if ($user->is_active == 'No') {
                    return response()->json($this->structure(false, "Your account is temporary In-active."), 200);
                }
                $user_id = $user->id;
            }
            
            try {
                //OTP is expire in 15 minutes over generated time.
                if ($this->sendOTP($request->phone, $user_id)) {
                    return response()->json($this->structure(true, "OTP send successfully."), 200);
                }
                return response()->json($this->structure(false, 'OTP not sent, Please try again!'), 200);
            } catch (\Throwable $th) {
                return response()->json($this->structure(false, "Internal server error!"), 200);
            }
        } 
        return response()->json($this->structure(false, $validator->errors()->first()), 200);
    }

    /**
     * Phone OR OTP Verification.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'otp' => 'required|numeric',
        ]);
        if (!$validator->fails()) {

            $otp_expire_time = '15'; //in minutes, change accordingly. 
            $user = User::where(['phone' => $request->phone])->first();
            if ($user) {

                if ($user->is_active == 'No') {
                    return response()->json($this->token_structure(false, 'User access is blocked!'), 200);
                }

                $secrete = Secrete::where(['user_id' => $user->id, 'user_type' => 'User', 'otp' => $request->otp, 'is_used' => 0])->first();
            }else{
                $secrete = Secrete::where(['phone' => $request->phone, 'user_type' => 'User', 'otp' => $request->otp, 'is_used' => 0])->first();
            }

            if (empty($secrete)) {
                return response()->json($this->token_structure(false, 'Please enter a valid OTP.'), 200);
            }
            //OTP is expire in 15 minutes over generated time.
            if (strtotime("+$otp_expire_time minutes", strtotime($secrete->created_at)) < strtotime(date('Y-m-d H:i:s'))) {
                return response()->json($this->token_structure(false, 'Your OTP is expired.'), 200);
            }

            try {
                
                //otp: mark as used. 
                Secrete::where('id', $secrete->id)->update(['is_used' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

                //update user if exist or create if not.
                if (empty($user)) {
                    $user = User::create(['phone' => $request->phone]);
                }else{
                    $user->updated_at = date('Y-m-d H:i:s');
                }

                if ($user->save()) {

                    //generate access token
                    // $token = auth('api')->login($user);
                    $token = $user->createToken('LaravelPassportSkeleton')->accessToken;
                    return response()->json($this->token_structure(true, 'User logged in successfully', $user, $token), 200);
                }
                return response()->json($this->token_structure(false, 'Something Went Wrong!'), 200);

            } catch (\Throwable $th) {
                return response()->json($this->structure(false, "Internal server error!"), 200);
            }
        } 
        return response()->json($this->token_structure(false, $validator->errors()->first()), 200);
    }

    private function sendOTP($phone, $id = NULL){

        //generate otp.
        $otp = 1234;
        // $otp = mt_rand(1000,9999);

        //generate message.
        // $message = new Message();
        // $msg     = $message->login($otp);
        
        //send otp.
        // $sms     = new Sms($phone, $msg);

        // if ($sms->send()) {
        if (true) { //when use real sms this will comment.

            $secrete = Secrete::where(['phone'=>$phone, 'user_type'=>'User', 'is_used'=>'No'])->first();
            if ($secrete) {
                Secrete::where('id', $secrete->id)
                                ->update([
                                            'otp' => $otp, 
                                            'created_at' => date("Y-m-d H:i:s")
                                        ]);
            }
            Secrete::create([
                                'user_id' => $id, 
                                'user_type' => 'User', 
                                'phone'=> $phone, 
                                'otp' => $otp, 
                                'created_at' => date("Y-m-d H:i:s")
                            ]);
            return true;
        }
        return false;
    }

    public function logout(Request $request){

        try {
            $user = auth('api')->user()->token();
            $user->revoke();
            return response()->json($this->structure(true, 'Logout successfully'), 200);
        } catch (\Throwable $th) {
            return response()->json($this->structure(false, "Internal server error!"), 200);
        }
    }

} //Class End Tag.
