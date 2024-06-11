<?php


namespace gift\api\app\actions;

use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction{
    private ICatalogue $catalogue;
    public function __construct(){
        $this->catalogue = new Catalogue();
    }

    public function __invoke(Request $request, Response $response, array $args): Response{

        try {
            $categories = $this->catalogue->getCategories();
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $response->getBody()->write(json_encode($categories));
        return $response->withHeader('Content-Type', 'application/json');
    }
}