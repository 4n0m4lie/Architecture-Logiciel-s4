<?php

namespace gift\api\app\utils;



class CsrfService{

    public static function generate(){
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check($token){

        if(!hash_equals($_SESSION['csrf_token'], $token)){

            unset($_SESSION['csrf_token']);
            return throw new CsrfException('csrf token error');
        }
        return true;
    }

}