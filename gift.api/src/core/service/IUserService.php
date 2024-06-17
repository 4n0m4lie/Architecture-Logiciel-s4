<?php

namespace gift\api\core\service;

use gift\api\core\domain\User;

interface IUserService{

    public function createUser(array $data);

    public function checkUser(array $data): bool;

    public function logout();

}