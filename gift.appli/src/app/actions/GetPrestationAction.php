<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $id=$request->getQueryParams();

        $trueId="1";
        $libelle="Champagne";
        $description="Bouteille de champagne + flutes + jeux à gratter";


        if ($id['id']==$trueId)
        {
            $aff = $libelle . "\n";
            $aff.= $description . "\n";
        }
        else
        {$aff = "ceci n'est pas un id valide";}
        $response->getBody()->write($aff);
        return $response;
    }
}