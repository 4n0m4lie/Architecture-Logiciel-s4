<?php

namespace gift\api\core\domain;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends \Illuminate\Database\Eloquent\Model{

    protected $table="box";
    protected $primaryKey="id";

    public $keyType='string';

    use HasUuids;


    public function box2presta(){
        return $this->belongsToMany('gift\api\core\domain\Prestation','box2presta', 'box_id', 'presta_id')
                    ->withPivot('quantite');
    }
}