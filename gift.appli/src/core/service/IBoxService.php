<?php

namespace gift\appli\core\service;

interface IBoxService{

    public function createBox(array $valeurs);

    public function getBox(array $valeurs):array;

    public function boxAddPrestation(string $idPrest, string $idBox);

    public function boxRemovePrestation(string $idPrest, string $idBox);
}