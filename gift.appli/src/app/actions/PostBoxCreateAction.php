<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\BoxService;
use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class PostBoxCreateAction extends AbstractAction{

    public function __construct(){
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        try {
            $this->boxService->createBox($data);
        } catch (OrmException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePostBoxCreate.twig', ['data' => $data]);
    }
}