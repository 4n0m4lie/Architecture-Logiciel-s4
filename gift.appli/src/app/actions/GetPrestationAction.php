<?php

namespace gift\appli\app\actions;

use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $request->getQueryParams();

        $aff = "Prestation : <br>";

        if (isset($id['id'])) {
            $prestation = Prestation::find($id['id']);

            if ($prestation == null) {
                throw new HttpNotFoundException($request, "prestation is not found");
            }
            $view = Twig::fromRequest($request);
            return $view->render($response, 'VuePrestation.twig', ['prestation' => $prestation]);
        } else {
            throw new HttpBadRequestException($request, "id is required");

        }
    }
}