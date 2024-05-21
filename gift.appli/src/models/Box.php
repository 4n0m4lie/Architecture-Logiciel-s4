<?php

namespace gift\appli\models;

class Box extends \Illuminate\Database\Eloquent\Model{

    protected $table="box";
    protected $primaryKey="id";


    public function box2presta(){
        return $this->belongsToMany('gift\appli\models\Prestation','box2presta', 'box_id', 'presta_id');
    }

}