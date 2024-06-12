<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\Catalogue;
use gift\appli\core\service\ICatalogue;

use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestatDeCategorieAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct(){
        $this->catalogue = new Catalogue();
    }
    public function __invoke(Request $request, Response $response, array $args): Response {

        if(!isset($args['id'])){
            throw new HttpBadRequestException($request, "id is required");
        }

        try {
            $res = $this->catalogue->getPrestationsbyCategorie($args['id']);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePrestaDeCategorie.twig', ['prestations' => $res['prestations'], 'categorie' => $res['categorie']]);
    }
}