<?php

namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategorieIdAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        $i = 0;
        $categorie = Categorie::find($id);
            $aff = $i .' - '. $categorie->libelle . "\n";
            $aff.= $categorie->description . "\n";
            $aff.= $categorie->tarif . "\n";
            $aff.= $categorie->unite . "\n";
            
        $response->getBody()->write($aff);
        return $response;

    }
}