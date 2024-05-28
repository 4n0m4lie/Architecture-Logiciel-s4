<?php

namespace gift\appli\core\domain;

class Categorie extends \Illuminate\Database\Eloquent\Model{
    protected $table = "categorie";
    protected $primaryKey = "id";

    public function prestation(){
        return $this->hasMany('gift\appli\core\domain\Prestation', 'cat_id');
    }

}

