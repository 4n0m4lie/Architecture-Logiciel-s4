<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\Box;
use gift\appli\core\domain\Prestation;

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
            $box->createur_id = $_SESSION['user']['id'];
            $box->save();

            $boxx = Box::where('libelle', $valeurs['libelle'])->first();

            $_SESSION['Box'] = ['id' => $boxx->id, 'user_id' => $_SESSION['user']['id']];

        }
    }

    public function visualisationBox($idBox): array{
        $box = Box::find($idBox);

        if(!$box){
            throw new OrmException("La box n'existe pas");
        }

        $prestations = $box->box2presta()->get();

        $prestationsArray = [];
        if($box->statut<4OR$box->statut>5) {
            $etat = "Pas Validé";
        }
        elseif ($box->statut===5)
        {
            $etat ="Validé";
        }
        else
        {
            $etat="Payé";
        }
        foreach ($prestations as $prestation){
            $prestationsArray[] = ['id' => $prestation->id, 'libelle' => $prestation->libelle, 'description' => $prestation->description, 'tarif' => $prestation->tarif, 'quantite' => $prestation->pivot->quantite];
        }
        return ['montant' => $box->montant,'libelle' => $box->libelle, 'prestations' => $prestationsArray,'etat'=>$etat];
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

        $tarif = $prestation->tarif;

        $box->montant += $tarif;
        $box->save();
    }

    public function boxRemovePrestation(string $idPrest, string $idBox){
        $box = Box::find($idBox);
        $prestation = Prestation::find($idPrest);
        if (!$box){
            throw new OrmException("La box n'existe pas");
        }
        if(!$prestation){
            throw new OrmException("La prestation n'existe pas");
        }

        if($box->box2presta()->where('presta_id', $prestation->id)->exists()){
            $res = $box->box2presta()->where('presta_id',$prestation->id)->first();
            $qq = $res->pivot->quantite - 1;
            $box->box2presta()->updateExistingPivot($prestation, ['quantite' => $qq]);
            $box->montant -= $prestation->tarif;
            $box->save();
            if($qq == 0){
                $box->box2presta()->detach($prestation);
            }
        }else{
            throw new OrmException("La prestation n'est pas dans la box");
        }
    }

    public function boxSupprPrestation(string $idPrest, string $idBox){
        $box = Box::find($idBox);
        $prestation = Prestation::find($idPrest);
        if (!$box){
            throw new OrmException("La box n'existe pas");
        }
        if(!$prestation){
            throw new OrmException("La prestation n'existe pas");
        }

        if($box->box2presta()->where('presta_id', $prestation->id)->exists()){
            $res = $box->box2presta()->where('presta_id',$prestation->id)->first();
            $qq = $res->pivot->quantite;
            $box->montant -= $prestation->tarif * $qq;
            $box->save();
            $box->box2presta()->detach($prestation);

        }else{
            throw new OrmException("La prestation n'est pas dans la box");
        }
    }

    public function boxListeCoffretsUser(string $idUser): array{

        try {
            $box = Box::where('createur_id', $idUser)->get();
        }catch (OrmException $e){
            throw new OrmException($e->getMessage());
        }

        $boxArray = [];
        foreach ($box as $b){
            $boxArray[] = ['id' => $b->id, 'libelle' => $b->libelle, 'description' => $b->description, 'montant' => $b->montant, 'statut' => $b->statut, 'token' => $b->token, 'createur_id' => $b->createur_id];
        }
        return $boxArray;
    }

    public function boxListeBoxPredefinie(): array{
        try {
            $box = Box::where('createur_id', null)->get();
        }catch (OrmException $e){
            throw new OrmException($e->getMessage());
        }

        $boxArray = [];
        foreach ($box as $b){
            $boxArray[] = ['id' => $b->id, 'libelle' => $b->libelle, 'description' => $b->description, 'montant' => $b->montant, 'statut' => $b->statut, 'token' => $b->token];
        }
        return $boxArray;
    }

    public function boxValidation(string $idBox)
    {
        $box = Box::find($idBox);
        if($box===null) {
            throw new OrmException("La box n'existe pas");
        }
        $prestations = $box->box2presta()->get();
        $prestationsArray=[];
        foreach ($prestations as $prestation){
            $prestationsArray[] = ['id' => $prestation->id, 'cat_id'=> $prestation->cat_id];
        }
        $deuxDif=false;
            for ($i=1;$i<count($prestationsArray);$i++)
            {
                if ($prestationsArray[0]['cat_id']!=$prestationsArray[$i]['cat_id'])
                {
                    $deuxDif=true;
                }
        }
        if (count($prestationsArray)<2 OR !$deuxDif) {
            throw new OrmException("La box n'est pas valide pas asser de prestations différentes");
        }

        $box->update(['statut'=>5]);
    }

    public function boxBuyVerify(string $idBox)
    {
        $box = Box::find($idBox);
        if($box===null) {
            throw new OrmException("La box n'existe pas");
        }
        if ($box->statut!==5)
        {
            throw new OrmException("La box n'est pas validé");
        }
    }

    public function boxBuyConfirm(string $idBox)
    {
        $box = Box::find($idBox);
        if($box===null) {
            throw new OrmException("La box n'existe pas");
        }
        $box->update(['statut'=>4]);
    }
    public function getBoxCourante():array
    {
        $box = Box::find($_SESSION['Box']['id']);

        if($box===null)
        {
            throw new OrmException("La box n'existe pas");
        }
        else
        {
            return ['description' => $box->description,'libelle' => $box->libelle,'id'=>$box->id ];
        }
    }
}