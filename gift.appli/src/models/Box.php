<?php

namespace gift\appli\src\models;

class Box extends \Illuminate\Database\Eloquent\Model{

    protected $table="box";
    protected $primaryKey="id";


    public function box2presta(){
        return $this->belongsToMany('gift\appli\src\models\Prestation','box2presta', 'box_id', 'presta_id');
    }

}