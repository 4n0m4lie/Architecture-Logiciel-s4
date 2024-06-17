<?php

namespace gift\appli\core\service;

interface IAuthorisationService{

        public function checkCreateBox($role): bool;
        public function checkModifyBox($role,$id,$user_id): bool;
        public function checkModifyCatalogue($role): bool;

}