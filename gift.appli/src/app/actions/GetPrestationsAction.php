<?php

namespace gift\appli\app\actions;

use gift\appli\models\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationsAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $request->getQueryParams();

        $aff = "Prestation : <br>";
        $prestations = Prestation::all();
        if ($prestations == null) {
            throw new HttpNotFoundException($request, "prestations not found");
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePrestations.twig', ['prestations' => $prestations]);

    }
}