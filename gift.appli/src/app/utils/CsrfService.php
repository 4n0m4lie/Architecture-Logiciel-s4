<?php

namespace gift\appli\app\utils;

use Slim\Exception\HttpForbiddenException;

class CsrfService{

    public static function generate(){
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function check($token){
        if(!hash_equals($_SESSION['csrf_token'], $token) || !isset($_SESSION['csrf_token'])){

            unset($_SESSION['csrf_token']);
            return throw new HttpForbiddenException( null, "Token invalide");
        }
        return true;
    }

}