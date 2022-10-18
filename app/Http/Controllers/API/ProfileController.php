<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Structure;
use App\Models\User;
use Validator;
use File;

class ProfileController extends Controller
{
    // Structure of response API.
    use Structure;

    private $user_id;
    
    public function __construct()
    {
        $this->user_id = isset(auth('api')->user()->id) ? auth('api')->user()->id : 0;
    }

    /**
     * Get the authenticated User profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        if ($profile = User::find($this->user_id)) {

            return response()->json($this->structure(true, 'Success', $profile), 200);
        }
        return response()->json($this->structure(false, 'Profile not found'), 200);
    }

}
