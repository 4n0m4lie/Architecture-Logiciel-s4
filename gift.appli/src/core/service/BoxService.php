<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\Box;

class BoxService implements IBoxService{

    public function createBox(array $valeurs){

        if(empty($valeurs)){
            throw new OrmException("Les valeurs sont vides");
        }

        if(empty($valeurs['libelle']) || $valeurs['description']){
            throw new OrmException("Valeur obligatoire vide");
        }

        if(!filter_var($valeurs['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
            throw new OrmException("Le libellé doit être une chaine de caractère");
        }

        if(!filter_var($valeurs['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
            throw new OrmException("La description doit être une chaine de caractère");
        }

        $box = Box::where('libelle', $valeurs['libelle'])->first();
        if($box){
            throw new OrmException("La box existe déjà");
        }else{
            $box = new Box();
            $box->libelle = $valeurs['libelle'];
            $box->description = $valeurs['description'];
            $box->save();
        }

    }

    public function getBox(array $valeurs): array
    {
        // TODO: Implement getBox() method.
    }

    public function boxAddPrestation(array $valeurs)
    {
        // TODO: Implement boxAddPrestation() method.
    }

    public function boxRemovePrestation(array $valeurs)
    {
        // TODO: Implement boxRemovePrestation() method.
    }
}