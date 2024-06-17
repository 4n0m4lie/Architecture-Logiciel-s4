<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfService;
use gift\appli\core\service\AuthorisationService;
use gift\appli\core\service\Catalogue;
use gift\appli\core\service\IAuthorisationService;
use gift\appli\core\service\ICatalogue;
use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetCategorieCreateAction extends AbstractAction{

    private IAuthorisationService $authorisationService;

    public function __construct(){
        $this->authorisationService = new AuthorisationService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response{

        if (!$this->authorisationService->checkModifyCatalogue($_SESSION['user']['role'])){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetCategorieCreate.twig',['csrf'=> CsrfService::generate()]);
    }
}