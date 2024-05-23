<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostBoxCreateAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $res = <<<HTML
        <h1>Box created</h1>
        <ul>
            <li>Libelle : {$data['libelle']}</li>
            <li>Description : {$data['description']}</li>
            <li>Montant : {$data['montant']}</li>
        </ul>
HTML;

        $response->getBody()->write($res);
        return $response;
    }
}