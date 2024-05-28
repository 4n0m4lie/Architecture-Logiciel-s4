<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\Categorie;
use gift\appli\core\domain\Prestation;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class Catalogue implements ICatalogue
{

    /*public function __construct(ICatalogue $catalogue)
    {
         $catalogue;
    }*/

    public function getCategories(): array
    {
        $categories = Categorie::all()->toArray();
        return $categories;
    }

    public function getCategorieById(int $id): Categorie
    {
        return $categorie = Categorie::find($id);
    }

    public function getPrestations(): array
    {
        return $prestation = Prestation::all()->toArray();
    }
    public function getPrestationById(string $id): Prestation
    {
        return $prestation = Prestation::find($id);
    }
    public function getPrestationsbyCategorie(int $categ_id):Categorie
    {
        return $categorie = Categorie::find($categ_id);
    }
}