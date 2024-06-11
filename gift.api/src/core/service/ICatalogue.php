<?php

namespace gift\api\core\service;

use gift\api\core\domain\Categorie;
use gift\api\core\domain\Prestation;

interface ICatalogue
{
    public function getCategories(): array;
    public function getCategorieById(int $id): Categorie;

    public function getPrestations(): array;
    public function getPrestationById(string $id): Prestation;
    public function getPrestationsbyCategorie(int $categ_id):Categorie;

    public function createCategorie(array $valeurs):string;

    public function modifyPrestation(array $valeurs);

    public function liaisonPrestationCategorie(string $idPrest,int $idCateg);

}