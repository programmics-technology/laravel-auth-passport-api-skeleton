<?php

namespace App\Library;

trait Structure
{
    // Structure of response API.
    public function structure($result, $msg , $data=[]){

        return ['success' => $result, 'message' => $msg , 'data' => $data];
    }

    public function token_structure($result, $msg , $data=[], $token = ""){

        return ['success' => $result, 'token' => $token, 'token_type' => 'bearer', 'message' => $msg , 'data' => $data];
    }
    
    public function action_structure($result, $msg , $data=[], $action = ""){

        return ['success' => $result, 'message' => $msg , 'data' => $data, 'action' => $action];
    }

    public function action_with_token_structure($result, $msg , $data=[], $token = "", $action = ""){

        return ['success' => $result, 'token' => $token, 'token_type' => 'bearer', 'message' => $msg , 'data' => $data, 'action' => $action];
    }
}

