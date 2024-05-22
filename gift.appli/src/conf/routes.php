<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function( \Slim\App $app): \Slim\App {
    /* home */

    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello, welcome to the gift-appli API");
        return $response;
    });

    return $app;

};