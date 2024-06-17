<?php

namespace gift\appli\app\actions;

use gift\appli\app\actions\AbstractAction;
use gift\appli\core\service\AuthorisationService;
use gift\appli\core\service\BoxService;
use gift\appli\core\service\IAuthorisationService;
use gift\appli\core\service\IBoxService;
use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;


class PostBoxBuy extends AbstractAction
{
    private IBoxService $boxService;
    private IAuthorisationService $authorisationService;

    public function __construct(){
        $this->boxService = new BoxService();
        $this->authorisationService = new AuthorisationService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        if (!$this->authorisationService->checkCreateBox($_SESSION['user']['role'])){
            return $response->withHeader('Location', '/auth')->withStatus(302);
        }

        try {
            $this->boxService->boxBuyVerify($request->getParsedBody()['id']);
        }
        catch (OrmException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueGetModPaiement.twig',['id'=>$request->getParsedBody()['id']]);
    }
}