<?php

namespace gift\api\core\service;

use Exception;
use gift\api\core\domain\Categorie;
use gift\api\core\domain\Prestation;
use Illuminate\Database\Eloquent\Casts\ArrayObject;

class Catalogue implements ICatalogue{

    /**
     * @throws OrmException
     */
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
        foreach ($categories as $key => $value) {
            $categories[$key] = [
                "categorie" => [
                    "id" => $value['id'],
                    "libelle" => $value['libelle'],
                    "description" => $value['description']
                ],
                "links" => [
                    "self" => ["href" => "/api/categories/".$value['id']]
                ]
            ];
        }
        return [
            "type"=> "collection",
            "count"=> count($categories),
            "categories"=> $categories
        ];
    }

    /**
     * @throws OrmException
     */
    public function getCategorieById(int $id): array
    {

        $categorie = null;

        try{
            $categorie = Categorie::find($id);
        }catch (Exception $e){
            echo $e->getMessage();
        }

        if ($categorie == null) {
            throw new OrmException("La catégorie n'a pas été trouvée");
        }

        return [
            'type' => 'resource',
            'categorie' => [
                'id' => $categorie->id,
                'libelle' => $categorie->libelle,
                'description' => $categorie->description
            ]
        ];
    }

    /**
     * @throws OrmException
     */
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
        $res = [];
        foreach ($prestations as $key => $value) {
            $res[$key] = [
                "prestation" => [
                    "id" => $value['id'],
                    "libelle" => $value['libelle'],
                    "description" => $value['description'],
                    "unite" => $value['unite'],
                    "montant" => $value['tarif'],
                    "image" => $value['img'],
                    "idCategorie" => $value['cat_id']
                ],
                "links" => [
                    "self" => ["href" => "/api/prestations/".$value['id']],
                    "categorie" => ["href" => "/api/categories/".$value['cat_id']],
                ]
            ];
        }
        return [
            "type"=> "collection",
            "count"=> count($res),
            "prestations"=> $res
        ];
    }

    /**
     * @throws OrmException
     */
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

        return [
            'type' => 'resource',
            'prestation' => [
                'id' => $prestation->id,
                'libelle' => $prestation->libelle,
                'description' => $prestation->description,
                'unite' => $prestation->unite,
                'montant' => $prestation->tarif,
                'image' => $prestation->img,
            ],
            'links' => [
                'categorie' => ['href' => '/api/categories/'.$prestation->cat_id]
            ]

        ];
    }

    /**
     * @throws OrmException
     */

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
            $prestations[] = [
                'prestation' => [
                    'id' => $prestation->id,
                    'libelle' => $prestation->libelle,
                    'description' => $prestation->description,
                    'unite' => $prestation->unite,
                    'tarif' => $prestation->tarif,
                    'img' => $prestation->img
                ],
                'links' => [
                    'self' => ['href' => '/api/prestations/'.$prestation->id]
                ]
            ];
        }

        return [
            'type' => 'collection',
            'count' => count($prestations),

            'categorie' => [
                'id' => $categorie->id,
                'libelle' => $categorie->libelle,
                'description' => $categorie->description
            ],
            'prestations' => $prestations];
    }

    /**
     * @throws OrmException
     */
    public function createCategorie(array $valeurs):string{

        //FILTER_VALIDATE_STRING

        $description = filter_var($valeurs['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $libelle = filter_var($valeurs['libelle'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($description === false || $libelle === false){
            throw new OrmException("Les valeurs ne sont pas valides");
        }

        $categorie = Categorie::where('libelle', $valeurs['libelle'] AND 'description', $valeurs['description'])->first();
        if ($categorie) {
            throw new OrmException("La catégorie existe déja");
        }
        else
        {
           $cat = new Categorie(['libelle' => $valeurs['libelle'],'description'=>$valeurs['description']]);
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