<?php

namespace gift\appli\src\models;

class Categorie extends \Illuminate\Database\Eloquent\Model{
    protected $table = "categorie";
    protected $primaryKey = "id";

    public function prestation(){
        return $this->hasMany('gift\appli\src\models\Prestation', 'cat_id');
    }

}

