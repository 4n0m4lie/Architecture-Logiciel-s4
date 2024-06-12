<?php

namespace gift\api\app\actions;

use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;

class GetCategorieIdAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }
    public function __invoke(Request $request, Response $response, array $args): Response{
        if(!isset($args['id'])){
            throw new HttpBadRequestException($request, "id is required");
        }

        $id = $args['id'];
        try {
            $categorie = $this->catalogue->getCategorieById($id);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $response->getBody()->write(json_encode($categorie));
        return $response->withHeader('Content-Type', 'application/json');
    }
}