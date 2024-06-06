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

class PostLiaisonPrestationCategorieAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct(){
        $this->catalogue = new Catalogue();
    }
    public function __invoke(Request $request, Response $response, array $args): Response{
        $body = $request->getParsedBody();

        if(empty($body)){
            throw new HttpBadRequestException($request, "modify is required");
        }
        try {
            $this->catalogue->liaisonPrestationCategorie($body['idPrestation'],$body['idCateg']);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }
        return $response->withHeader('Location', '/prestation/?id='.$body['idPrestation'])->withStatus(302);
    }
}