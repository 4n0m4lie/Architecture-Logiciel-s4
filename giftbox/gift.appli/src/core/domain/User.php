<?php

namespace gift\appli\core\domain;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends \Illuminate\Database\Eloquent\Model{
    protected $table = "user";
    protected $primaryKey = "id";

    public $keyType='string';

    public $timestamps = false;

    use HasUuids;

}