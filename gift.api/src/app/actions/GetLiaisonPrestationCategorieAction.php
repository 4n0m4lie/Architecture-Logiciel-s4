<?php

namespace gift\api\app\actions;

use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetLiaisonPrestationCategorieAction extends AbstractAction{

    private ICatalogue $catalogue;

    /**
     * @throws SyntaxError
     * @throws OrmException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response{
        $this->catalogue = new Catalogue();
        $id = $request->getQueryParams()['id'];
        $presta = $this->catalogue->getPrestationById($id);

        $categories = (new Catalogue)->getCategories();

        $data = [
            'categories' => $categories,
            'Presta' => $presta
        ];

        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetLiaisonPrestationCategorie.twig', $data);
    }
}