<?php

namespace gift\appli\core\service;

interface IBoxService{



    public function createBox(array $valeurs);

    public function getBox(array $valeurs):array;

    public function boxAddPrestation(array $valeurs);

    public function boxRemovePrestation(array $valeurs);



}