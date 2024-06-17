<?php

namespace gift\appli\core\domain;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Box extends \Illuminate\Database\Eloquent\Model{

    protected $table="box";
    protected $primaryKey="id";

    public $keyType='string';

    protected $fillable=['statut'];
    use HasUuids;


    public function box2presta(){
        return $this->belongsToMany('gift\appli\core\domain\Prestation','box2presta', 'box_id', 'presta_id')
                    ->withPivot('quantite');
    }
}