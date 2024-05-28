<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostBoxCreateAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VuePostBoxCreate.twig', ['data' => $data]);
    }
}