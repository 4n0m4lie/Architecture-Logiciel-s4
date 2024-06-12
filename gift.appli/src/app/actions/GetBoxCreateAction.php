<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\AuthorisationService;
use gift\appli\core\service\BoxService;
use gift\appli\core\service\Catalogue;
use gift\appli\core\service\IAuthorisationService;
use gift\appli\core\service\IBoxService;
use gift\appli\core\service\ICatalogue;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetBoxCreateAction extends AbstractAction{

    private IAuthorisationService $authorisationService;
    private IBoxService $boxService;

    public function __construct(){
        $this->authorisationService = new AuthorisationService();
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response {

        $res = $request->getQueryParams();

        $predef = ['id'=>-1,'libelle'=>''];

        if(isset($res['id'])){
            $predef = ['id'=>$res['id'],'libelle'=>$res['libelle']];
        }

        if (!$this->authorisationService->checkCreateBox()){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        $box = $this->boxService->boxListeBoxPredefinie();

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueGetBoxCreate.twig',['boxs' => $box,'predef' => $predef]);
    }
}