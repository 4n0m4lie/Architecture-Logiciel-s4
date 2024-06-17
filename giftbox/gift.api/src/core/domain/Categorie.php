<?php

namespace gift\api\core\domain;

class Categorie extends \Illuminate\Database\Eloquent\Model{
    protected $table = "categorie";
    protected $primaryKey = "id";
    public $timestamps=false;
    protected $fillable = ['libelle','description'];

    public function prestation(){
        return $this->hasMany('gift\api\core\domain\Prestation', 'cat_id');
    }

}

