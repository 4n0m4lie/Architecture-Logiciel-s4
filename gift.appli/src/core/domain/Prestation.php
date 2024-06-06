<?php

namespace gift\appli\core\domain;

class Prestation extends \Illuminate\Database\Eloquent\Model{
    protected $table="prestation";
    protected $primaryKey="id";
    public $keyType='string';



    public $timestamps=false;

    public function box2presta(){
        return $this->belongsToMany('gift\appli\core\domain\Box','box2presta', 'presta_id', 'box_id');
    }

    public function categorie(){
        return $this->belongsTo('gift\appli\core\domain\Categorie', 'cat_id');
    }

    public static function modifyIdCateg(string $idPrest,int $idCateg)
    {
        Prestation::where('id',$idPrest)->update(['cat_id'=>$idCateg]);
    }


}