<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\User;

interface IUserService{

    public function createUser(array $data);

    public function checkUser(array $data): array;

}