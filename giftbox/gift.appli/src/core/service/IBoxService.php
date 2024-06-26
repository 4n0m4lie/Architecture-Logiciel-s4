<?php

namespace gift\appli\core\service;

interface IBoxService{

    public function createBox(array $valeurs,$id):array;

    public function visualisationBox(string $idBox):array;

    public function boxAddPrestation(string $idPrest, string $idBox);

    public function boxRemovePrestation(string $idPrest, string $idBox);

    public function boxSupprPrestation(string $idPrest, string $idBox);

    public function boxListeCoffretsUser(string $idUser):array;

    public function boxListeBoxPredefinie():array;

    public function boxValidation(string $idBox);

    public function boxBuyVerify(string $idBox);
    public function boxBuyConfirm(string $idBox);

    public function boxGet(string $idBox):array;

    public function createBoxWithPredefini(array $b, array $data,$id):array;

    public function getBoxCourante($idBox):array;
}