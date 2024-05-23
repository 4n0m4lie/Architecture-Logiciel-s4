<?php

namespace gift\appli\utils;


use Illuminate\Database\Capsule\Manager as DB;

class Eloquent {

    public static function init($conf){

        $conf = parse_ini_file($conf);

        $db = new DB();
        $db->addConnection($conf);
        $db->setAsGlobal();
        $db->bootEloquent();

        //testConnection
        if($db->connection()->getDatabaseName()){
            echo "Connection à la base de donnée \n";
        }
    }

}