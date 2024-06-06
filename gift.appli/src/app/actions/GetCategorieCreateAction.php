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

class GetCategorieCreateAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{

        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetCategorieCreate.twig');
    }
}