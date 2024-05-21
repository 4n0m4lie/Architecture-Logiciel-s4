<?php

namespace gift\appli\models;

class Prestation extends \Illuminate\Database\Eloquent\Model{
    protected $table="prestation";
    protected $primaryKey="id";

    public function box2presta(){
        return $this->belongsToMany('gift\appli\models\Box','box2presta', 'presta_id', 'box_id');
    }

    public function categorie(){
        return $this->belongsTo('gift\appli\models\Categorie', 'cat_id');
    }



}