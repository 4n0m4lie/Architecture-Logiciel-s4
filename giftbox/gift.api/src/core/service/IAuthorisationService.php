<?php

namespace gift\api\core\service;

interface IAuthorisationService{

        public function checkCreateBox(): bool;
        public function checkModifyBox(): bool;
        public function checkModifyCatalogue(): bool;

}