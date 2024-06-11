<?php

namespace gift\api\core\service;

class AuthorisationService implements IAuthorisationService{

    public function checkCreateBox(): bool{
        $role = $_SESSION['user']['role'];
        if($role >= 1){
            return true;
        }else{
            return false;
        }

    }

    public function checkModifyBox(): bool{
        $role = $_SESSION['user']['role'];
        $id = $_SESSION['user']['id'];
        $user_id = $_SESSION['Box']['user_id'];
        if($role >= 1){
            if($user_id == $id){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }


    }

    public function checkModifyCatalogue(): bool{
        $role = $_SESSION['user']['role'];
        if($role == 100){
            return true;
        }else{
            return false;
        }
    }
}