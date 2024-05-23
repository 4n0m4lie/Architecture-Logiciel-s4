<?php

namespace gift\appli\app\actions;

use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $id=$request->getQueryParams();

        $prestation = Prestation::find($id);

            $aff =' - '. $prestation->libelle . "\n";
            $aff.= $prestation->description . "\n";
            $aff.= $prestation->tarif . "\n";
            $aff.= $prestation->unite . "\n";

        $aff = "ceci n'est pas un id valide";
        $response->getBody()->write($aff);
        return $response;
    }
}