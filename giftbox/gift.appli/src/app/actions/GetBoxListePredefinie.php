<?php

namespace gift\appli\app\actions;

use gift\appli\core\domain\Box;
use gift\appli\core\service\BoxService;
use gift\appli\core\service\IBoxService;
use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class GetBoxListePredefinie extends AbstractAction{

    private IBoxService $boxService;

    public function __construct(){
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response {

        try{
            $box = $this->boxService->boxListeBoxPredefinie();
        }catch (OrmException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueGetBoxListePredefinie.twig',['boxs' => $box]);
    }

}