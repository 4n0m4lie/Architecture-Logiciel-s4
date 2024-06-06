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

    public function createCategorie(array $valeurs):string{

        //FILTER_VALIDATE_STRING

        $description = filter_var($valeurs['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $libelle = filter_var($valeurs['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($description === false || $libelle === false){
            throw new OrmException("Les valeurs ne sont pas valides");
        }

        $categorie = Categorie::where('libelle', $valeurs['libelle'] AND 'description', $valeurs['description'])->first();
        if ($categorie === null) {
            $categorie = new Categorie(['libelle' => $valeurs['libelle'],'description'=>$valeurs['description']]);
        }
        else
        {
            throw new OrmException("La catégorie existe déja");
        }

        $categorie->save();
        return $categorie->getKey();
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