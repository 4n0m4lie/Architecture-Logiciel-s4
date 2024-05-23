<?php

namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetBoxCreateAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $res = <<<HTML
        <h1>Create a box</h1>
        <form action="/box/create" method="post">
            <label for="libelle">Libelle</label>
            <input type="text" id="libelle" name="libelle">
            <label for="description">Description</label>
            <input type="text" id="description" name="description">
            <label for="montant">Montant</label>
            <input type="number" id="montant" name="montant"> 
            <button  type="submit">Create</button>
        </form>
HTML;
        $response->getBody()->write($res);
        return $response;
    }
}