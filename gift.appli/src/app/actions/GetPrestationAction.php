<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\Catalogue;
use gift\appli\core\service\ICatalogue;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class GetPrestationAction extends AbstractAction{

    private ICatalogue $catalogue;
    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $request->getQueryParams();

        if (isset($id['id'])) {
            $prestation = $this->catalogue->getPrestationById($id['id']);

            if ($prestation == null) {
                throw new HttpNotFoundException($request, "prestation is not found");
            }
            $view = Twig::fromRequest($request);
            return $view->render($response, 'VuePrestation.twig', ['prestation' => $prestation]);
        } else {
            throw new HttpBadRequestException($request, "id is required");

        }
    }
}