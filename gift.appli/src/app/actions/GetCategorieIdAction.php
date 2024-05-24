<?php

namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetCategorieIdAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{
        if(!isset($args['id'])){
            throw new HttpBadRequestException($request, "id is required");
        }

        $id = $args['id'];
        $i = 0;
          $aff = "<p>";
        $categorie = Categorie::find($id);

        if ($categorie == null) {
            throw new HttpNotFoundException($request, "categorie is not found");
        }
        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueCategorie.twig', ['categorie' => $categorie]);
    }
}