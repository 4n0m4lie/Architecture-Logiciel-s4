<?php


namespace gift\appli\app\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $actualUrl = $request->getUri();
        $res = <<<HTML
            <h1>CATEGORIES</h1>
        <ul>
                <li><a href="/categories/1">Catégorie 1 - Bien-être</a></li>
                <li><a href="/categories/2">Catégorie 2 - Gastronomie</a></li>
                <li><a href="/categories/3">Catégorie 3 - Sport</a></li>
                <li><a href="/categories/4">Catégorie 4 - Aventure</a></li>
                <li><a href="/categories/5">Catégorie 5 - Culture</a></li>
        </ul>
        HTML;

        $response->getBody()->write($res);
        return $response;
    }
}