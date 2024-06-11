<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\User;

class UserService implements IUserService{

    public function createUser(array $data){

        if (empty($data['login'])){
            throw new OrmException("login is required");
        }

        if(!filter_var($data['login'], FILTER_VALIDATE_EMAIL)){
            throw new OrmException("login must be an email");
        }

        if (empty($data['password'])){
            throw new OrmException("password is required");
        }

        if (strlen($data['password']) < 8){
            throw new OrmException("password must be at least 8 characters");
        }

        if(!preg_match('/[A-Z]/', $data['password'])){
            throw new OrmException("password must contain at least one uppercase letter");
        }

        if(!preg_match('/[a-z]/', $data['password'])){
            throw new OrmException("password must contain at least one lowercase letter");
        }

        if(!preg_match('/[0-9]/', $data['password'])){
            throw new OrmException("password must contain at least one number");
        }

        if(!preg_match('/[^a-zA-Z0-9]/', $data['password'])){
            throw new OrmException("password must contain at least one special character");
        }

        if(User::where('user_id', $data['login'])->first() != null){
            throw new OrmException("login already exists");
        }

        $user = new User();
        $user->user_id = $data['login'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        $user->role = 1;
        $user->save();
    }

    public function checkUser(array $data): bool{
        $userid = $data['login'];
        $password = $data['password'];

        if (empty($userid) || empty($password)){
            return false;
        }

        if (!filter_var($userid, FILTER_VALIDATE_EMAIL)){
            throw new OrmException("login must be an email");
        }

        $user = User::where('user_id', $userid)->first();
        if ($user == null){
            return false;
        }

        if(!password_verify($password, $user->password)){
            return false;
        }else{
            $_SESSION['user'] = ['login' => $user->user_id, 'role' => $user->role, 'id' => $user->id];
            return true;
        }
    }

    public function logout(){
        unset($_SESSION['user']);
    }
}