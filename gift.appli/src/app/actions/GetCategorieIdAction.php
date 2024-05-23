<?php

namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategorieIdAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        $i = 0;
          $aff = "<p>";
        $categorie = Categorie::find($id);
            $aff.= $i .' - '. $categorie->libelle . " ";
            $aff.= $categorie->description . " ";
            $aff.= $categorie->tarif . " ";
            $aff.= $categorie->unite . " ";

            $aff.= "</p>";

            $res = <<<HTML
{$aff}
HTML;

        $response->getBody()->write($res);
        return $response;

    }
}