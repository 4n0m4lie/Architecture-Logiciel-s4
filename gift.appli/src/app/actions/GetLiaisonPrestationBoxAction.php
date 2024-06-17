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

class GetLiaisonPrestationBoxAction extends AbstractAction{

    private BoxService $boxService;
    private IAuthorisationService $authorisationService;

    public function __construct(){
        $this->boxService = new BoxService();
        $this->authorisationService = new AuthorisationService();
    }
    public function __invoke(Request $request, Response $response, array $args): Response{
        $idPresta = $request->getQueryParams()['id'];

        if (!$this->authorisationService->checkModifyBox($_SESSION['user']['role'], $_SESSION['user']['id'], $_SESSION['Box']['user_id'])){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        if(empty($idPresta)){
            throw new HttpBadRequestException($request, "id is required");
        }


        try {
            $idb =$_SESSION['Box']['id'];
            $this->boxService->boxAddPrestation($idPresta,$idb);
            //$this->boxService->boxAddPrestation($idPresta,"9c4090df-de96-4cad-9bef-17a0f3ce063c");
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }
        return $response->withHeader('Location', '/prestation/?id='.$idPresta)->withStatus(302);
    }
}