<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\AuthorisationService;
use gift\appli\core\service\Catalogue;
use gift\appli\core\service\IAuthorisationService;
use gift\appli\core\service\ICatalogue;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetBoxCreateAction extends AbstractAction{

    private IAuthorisationService $authorisationService;

    public function __construct(){
        $this->authorisationService = new AuthorisationService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response {

        if (!$this->authorisationService->checkCreateBox()){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueGetBoxCreate.twig');
    }
}