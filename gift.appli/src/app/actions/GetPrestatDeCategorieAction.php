<?php

namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use gift\appli\utils\Eloquent;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestatDeCategorieAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {

        if(!isset($args['id'])){
            throw new HttpBadRequestException($request, "id is required");
        }

        $categorie = Categorie::find($args['id']);

        if($categorie == null){
            throw new HttpNotFoundException($request, "categorie is not found");
        }

        $prestations = $categorie->prestation;
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePrestaDeCategorie.twig', ['prestations' => $prestations, 'categorie' => $categorie]);
    }
}