<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategorieIdAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        $res = <<<HTML
    <h1>CATEGORIE $id</h1>
HTML;

        $response->getBody()->write($res);
        return $response;

    }
}