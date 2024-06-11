<?php

namespace gift\api\app\actions;

use gift\api\app\utils\CsrfService;
use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetRegister extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{

        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetRegister.twig');
    }
}