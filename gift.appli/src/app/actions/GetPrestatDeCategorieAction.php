<?php

namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use gift\appli\utils\Eloquent;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

class GetPrestatDeCategorieAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {

        if(!isset($args['id'])){
            throw new HttpBadRequestException($request, "id is required");
        }

        $categorie = Categorie::find($args['id']);

        if($categorie == null){
            throw new HttpNotFoundException($request, "categorie is not found");
        }

        $aff = "<h2> ". $categorie->libelle ."</h2> ";
        $i =0;
        $aff.="<ul>";
        foreach($categorie->prestation as $prestation){
            $i++;
            $aff.= "<li>";
            $aff.= $i .' - '. $prestation->libelle;
            $aff.= $prestation->tarif ;
            $aff.= $prestation->unite ;
            $aff.= "</li>";
        }
        $aff.="</ul>";

        $res = <<<HTML
{$aff}
HTML;

        $response->getBody()->write($res);
        return $response;
    }
}