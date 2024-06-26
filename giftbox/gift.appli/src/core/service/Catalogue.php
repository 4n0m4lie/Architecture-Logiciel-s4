<?php

namespace gift\appli\core\service;

use Exception;
use gift\appli\core\domain\Categorie;
use gift\appli\core\domain\Prestation;

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

    public function getCategorieById(int $id): array{

        $categorie = null;

        try{
            $categorie = Categorie::find($id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($categorie == null) {
            throw new OrmException("La catégorie n'a pas été trouvée");
        }

        return ['id' => $categorie->id, 'libelle' => $categorie->libelle, 'description' => $categorie->description];
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

    public function getPrestationsTrier($ascendant): array{

        $prestations = [];

        try{
            $prestations = Prestation::all()->toArray();
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if (empty($prestations)){
            throw new OrmException("Aucune prestation n'a été trouvée");
        }

        $trier = array_column($prestations, 'tarif');
        if ($ascendant) {
            array_multisort($trier, SORT_ASC, $prestations);
        }
        else
        {
            array_multisort($trier, SORT_DESC, $prestations);
        }

        return $prestations;
    }
    public function getPrestationById(string $id): array{

        $prestation = null;

        try {
            $prestation = Prestation::find($id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($prestation == null){
            throw new OrmException("La prestation n'a pas été trouvée");
        }

        return ['id' => $prestation->id, 'libelle' => $prestation->libelle, 'description' => $prestation->description, 'unite' => $prestation->unite, 'tarif' => $prestation->tarif, 'img'=>$prestation->img];
    }
    public function getPrestationsbyCategorie(int $categ_id):array{

        $categorie = null;

        try{
            $categorie = Categorie::find($categ_id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($categorie == null){
            throw new OrmException("La catégorie n'a pas été trouvée");
        }

        $prestations = [];

        $p = Prestation::where('cat_id', $categ_id)->get();

        foreach ($p as $prestation){
            $prestations[] = ['id' => $prestation->id, 'libelle' => $prestation->libelle, 'description' => $prestation->description, 'unite' => $prestation->unite, 'tarif' => $prestation->tarif, 'img'=>$prestation->img];
        }

        return ['categorie' => ['id' => $categorie->id, 'libelle' => $categorie->libelle, 'description' => $categorie->description], 'prestations' => $prestations];
    }

    public function createCategorie(array $valeurs):string{

        //FILTER_VALIDATE_STRING

        $description = filter_var($valeurs['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $libelle = filter_var($valeurs['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($description === false || $libelle === false){
            throw new OrmException("Les valeurs ne sont pas valides");
        }

        $categorie = Categorie::where('libelle', $valeurs['libelle'] AND 'description', $valeurs['description'])->first();
        if ($categorie) {
            $cat = new Categorie(['libelle' => $valeurs['libelle'],'description'=>$valeurs['description']]);
        }
        else
        {
            throw new OrmException("La catégorie existe déja");
        }

        $cat->save();
        return $cat->getKey();
    }

    /**
     * @throws OrmException
     */
    public function modifyPrestation(array $valeurs)
    {

        $prestation = Prestation::where('id',$valeurs['id']);

        if ($prestation===null) {
            throw new OrmException("La prestation n'existe pas");
        }
        else
        {
            $prestation
                ->update(
                    [
                        'libelle'=>$valeurs['libelle'],
                        'description'=>$valeurs['description'],
                        'unite'=>$valeurs['unite'],
                        'tarif'=>$valeurs['montant']
                    ]
                );

        }

    }

    public function liaisonPrestationCategorie(string $idPrest, int $idCateg)
    {
        $prestation = Prestation::where('id',$idPrest);
        if ($prestation===null) {
            throw new OrmException("La prestation n'existe pas");
        }
        else
        {
            Prestation::modifyIdCateg($idPrest,$idCateg);
        }
    }
}