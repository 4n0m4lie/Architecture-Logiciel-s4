<?php

namespace gift\api\app\actions;

use gift\api\core\service\AuthorisationService;
use gift\api\core\service\BoxService;
use gift\api\core\service\Catalogue;
use gift\api\core\service\IAuthorisationService;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
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

        if (!$this->authorisationService->checkModifyBox()){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        if(empty($idPresta)){
            throw new HttpBadRequestException($request, "id is required");
        }
        try {
            $this->boxService->boxAddPrestation($idPresta,$_SESSION['Box']['id']);
            //$this->boxService->boxAddPrestation($idPresta,"9c4090df-de96-4cad-9bef-17a0f3ce063c");
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }
        return $response->withHeader('Location', '/prestation/?id='.$idPresta)->withStatus(302);
    }
}