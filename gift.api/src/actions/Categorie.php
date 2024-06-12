<?php

namespace gift\api\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Categorie
{
    public function cat1(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('Hello World');
        return $response;
    }

    public function test(Request $request, Response $response, array $args): Response
    {
        $response->getBody()->write('Hello World 2');
        return $response;
    }
}