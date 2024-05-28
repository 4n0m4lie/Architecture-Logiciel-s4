<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\Catalogue;
use gift\appli\core\service\ICatalogue;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationsAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $request->getQueryParams();

        $aff = "Prestation : <br>";
        $prestations = $this->catalogue->getPrestations();
        if ($prestations == null) {
            throw new HttpNotFoundException($request, "prestations not found");
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePrestations.twig', ['prestations' => $prestations]);

    }
}