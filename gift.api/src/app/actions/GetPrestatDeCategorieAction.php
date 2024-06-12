<?php

namespace gift\api\app\actions;

use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
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
        try {
            $prestations = $this->catalogue->getPrestationsByCategorie($args['id']);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        if (empty($prestations)){
            throw new HttpNotFoundException($request, "Aucune prestation n'a été trouvée pour cette catégorie");
        }


        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($prestations));
        return $response;
    }
}