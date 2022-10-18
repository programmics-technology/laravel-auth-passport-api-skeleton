<?php
namespace App\Library;

class Message
{
    private $message;

    public function __construct(String $message = '')
    {
        $this->message = $message;
    }

    public function login($otp)
    {
        
        return ($this->message != '') ? $this->message : " $otp is the OTP for Laravel Login/Register. OTP is valid for 5 Minutes. Do not share this OTP with anyone" ;
    }


    public function forget_password($otp, String $name = 'User')
    {

        return ($this->message != '') ? $this->message : " $otp is the OTP for Laravel Login/Register. OTP is valid for 5 Minutes. Do not share this OTP with anyone" ;
    }

}
