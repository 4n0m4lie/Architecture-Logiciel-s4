<?php

namespace gift\appli\core\service;

use gift\appli\core\domain\Categorie;
use gift\appli\core\domain\Prestation;

interface ICatalogue
{
    public function getCategories(): array;
    public function getCategorieById(int $id): Categorie;

    public function getPrestations(): array;
    public function getPrestationById(string $id): Prestation;
    public function getPrestationsbyCategorie(int $categ_id):Categorie;

    public function createCategorie(array $valeurs):string;

    public function modifyPrestation(array $valeurs);

}