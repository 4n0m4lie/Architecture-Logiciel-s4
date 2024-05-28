<?php

namespace gift\appli\core\service;

use Exception;
use gift\appli\core\domain\Categorie;
use gift\appli\core\domain\Prestation;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class Catalogue implements ICatalogue{

    public function getCategories(): array{

        $categories = [];

        try{
            $categories = Categorie::all()->toArray();
        }catch(Exception $e){
            echo $e->getMessage();
        }

        if(empty($categories)){
            throw new OrmException("Aucune catégorie n'a été trouvée");
        }

        return $categories;
    }

    public function getCategorieById(int $id): Categorie{

        $categorie = null;

        try{
            $categorie = Categorie::find($id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($categorie == null) {
            throw new OrmException("La catégorie n'a pas été trouvée");
        }

        return $categorie;
    }

    public function getPrestations(): array{

        $prestations = [];

        try{
            $prestations = Prestation::all()->toArray();
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if (empty($prestations)){
            throw new OrmException("Aucune prestation n'a été trouvée");
        }
        return $prestations;
    }
    public function getPrestationById(string $id): Prestation{

        $prestation = null;

        try {
            $prestation = Prestation::find($id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($prestation == null){
            throw new OrmException("La prestation n'a pas été trouvée");
        }

        return $prestation;
    }
    public function getPrestationsbyCategorie(int $categ_id):Categorie{

        $categorie = null;

        try{
            $categorie = Categorie::find($categ_id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($categorie == null){
            throw new OrmException("La catégorie n'a pas été trouvée");
        }

        return $categorie;
    }
}