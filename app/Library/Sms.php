<?php

namespace App\Library;

use DB;

class Sms
{
    var $number, $msg;
    public function __construct($number, $msg)
    {
        $this->number = $number;
        $this->msg = $msg;
    }

    public function send()
    {
        $msg = $this->msg;
        $apiKey = 'you api key';
        $numbers = array('91'.$this->number);
        $sender = urlencode('OPANAP');
        $message = rawurlencode($msg);
        $numbers = implode(',', $numbers);
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response,true);
    }

}

