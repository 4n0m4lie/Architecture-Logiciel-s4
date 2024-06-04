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

class GetPrestationModifyAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct(){
        $this->catalogue = new Catalogue();
    }

    public function __invoke(Request $request, Response $response, array $args): Response{
        $id = $request->getQueryParams()['id'];
        try {
            $prestation = $this->catalogue->getPrestationById($id);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }
        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetPrestationModify.twig', ['prestation' => $prestation]);
    }
}