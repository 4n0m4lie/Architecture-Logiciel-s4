<?php

namespace gift\appli\models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends \Illuminate\Database\Eloquent\Model{

    protected $table="box";
    protected $primaryKey="id";

    use HasUuids;


    public function box2presta(){
        return $this->belongsToMany('gift\appli\models\Prestation','box2presta', 'box_id', 'presta_id');
    }

}