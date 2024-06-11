<?php

namespace gift\api\core\service;

use gift\api\core\domain\Box;
use gift\api\core\domain\Prestation;

class BoxService implements IBoxService{

    const CREATED = 1;

    public function createBox(array $valeurs){

        if(empty($valeurs)){
            throw new OrmException("Les valeurs sont vides");
        }

        if(empty($valeurs['libelle']) || empty($valeurs['description'])){
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
            $box->montant = 0;
            $box->token=bin2hex(random_bytes(32));
            $box->statut = self::CREATED;
            $box->createur_id = $valeurs['user_id'];
            $box->save();

            $boxx = Box::where('libelle', $valeurs['libelle'])->first();

            $_SESSION['Box'] = ['id' => $boxx->id, 'user_id' => $valeurs['user_id']];

        }
    }

    public function getBox(array $valeurs): array
    {
        // TODO: Implement getBox() method.
        return array();
    }

    public function boxAddPrestation(string $idPrest, string $idBox){
        $box = Box::find($idBox);
        $prestation = Prestation::find($idPrest);
        if (!$box){
            throw new OrmException("La box n'existe pas");
        }
        if(!$prestation){
            throw new OrmException("La prestation n'existe pas");
        }

        $qq = 1;
        if($box->box2presta()->where('presta_id', $prestation->id)->exists()){
            $res = $box->box2presta()->where('presta_id',$prestation->id)->first();
            $qq = $res->pivot->quantite + 1;
            $box->box2presta()->updateExistingPivot($prestation, ['quantite' => $qq]);
        }else{
            $box->box2presta()->attach($prestation, ['quantite' => $qq]);
        }
    }

    public function boxRemovePrestation(string $idPrest, string $idBox){
        $box = Box::find($_SESSION['boxSession']);
        $prestation = Prestation::find($idPrest);
        if (!$box){
            throw new OrmException("La box n'existe pas");
        }
        if(!$prestation){
            throw new OrmException("La prestation n'existe pas");
        }

        if($box->box2presta()->where('prestation_id', $prestation->id)->exists()){
            $qq = $box->box2presta()->where('prestation_id')->first();
            $qq->pivot->quantite -= 1;
            if($qq->pivot->quantite == 0){
                $box->box2presta()->detach($prestation);
            }
        }else{
            throw new OrmException("La prestation n'est pas dans la box");
        }
    }
}