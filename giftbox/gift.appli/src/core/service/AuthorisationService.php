<?php

namespace gift\appli\core\service;

class AuthorisationService implements IAuthorisationService{

    public function checkCreateBox($role): bool{
        if($role >= 1){
            return true;
        }else{
            return false;
        }

    }

    public function checkModifyBox($role,$id,$user_id): bool{
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

    public function checkModifyCatalogue($role): bool{
        if($role == 100){
            return true;
        }else{
            return false;
        }
    }
}