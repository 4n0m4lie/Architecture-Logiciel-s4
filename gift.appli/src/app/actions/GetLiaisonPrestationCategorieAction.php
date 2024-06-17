<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\AuthorisationService;
use gift\appli\core\service\BoxService;
use gift\appli\core\service\Catalogue;
use gift\appli\core\service\IAuthorisationService;
use gift\appli\core\service\ICatalogue;
use gift\appli\core\service\OrmException;
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

    private IAuthorisationService $authorisationService;

    public function __construct(){
        $this->catalogue = new Catalogue();
        $this->authorisationService = new AuthorisationService();
    }

    /**
     * @throws SyntaxError
     * @throws OrmException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $request, Response $response, array $args): Response{
        $id = $request->getQueryParams()['id'];
        $presta = $this->catalogue->getPrestationById($id);

        $categories = $this->catalogue->getCategories();

        if (!$this->authorisationService->checkModifyCatalogue($_SESSION['user']['role'])){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        $data = [
            'categories' => $categories,
            'Presta' => $presta
        ];

        $view =Twig::fromRequest($request);
        return $view->render($response, 'VueGetLiaisonPrestationCategorie.twig', $data);
    }
}