<?php

namespace gift\appli\app\actions;

use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $id=$request->getQueryParams();

        $aff = "Prestation : <br>";

        if (isset($id['id'])) {
            $prestation = Prestation::find($args['$id']);

            $aff .=' - '. $prestation->libelle . " ";
            $aff.= $prestation->description . " ";
            $aff.= $prestation->tarif . " ";
            $aff.= $prestation->unite . " ";
        }else{
            $aff .= "ceci n'est pas un id valide";
        }

        $res = <<<HTML
{$aff}
HTML;

        $response->getBody()->write($res);
        return $response;
    }
}