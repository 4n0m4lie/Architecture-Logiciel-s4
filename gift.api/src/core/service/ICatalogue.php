<?php

namespace gift\api\core\service;

use gift\api\core\domain\Categorie;
use gift\api\core\domain\Prestation;

interface ICatalogue
{
    public function getCategories(): array;
    public function getCategorieById(int $id): array;

    public function getPrestations(): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsByCategorie(int $categ_id):array;

    public function createCategorie(array $valeurs):string;

    public function modifyPrestation(array $valeurs);

    public function liaisonPrestationCategorie(string $idPrest,int $idCateg);

}