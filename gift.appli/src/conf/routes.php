<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxCreateAction;
use gift\appli\app\actions\GetCategorieIdAction;
use gift\appli\app\actions\GetCategoriesAction;
use gift\appli\app\actions\GetPrestatDeCategorieAction;
use gift\appli\app\actions\GetPrestationAction;
use gift\appli\app\actions\PostBoxCreateAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function( \Slim\App $app): \Slim\App {
    /* home */

    $app->get('/', function (Request $request, Response $response, array $args) {
        $res = <<<HTML
    <h1>Welcome to the gift-appli API</h1>
    <ul>
        <li><a href="/prestation?id=1">Prestation</a></li>
        <li><a href="/box/create">Create a box</a></li>
        <li><a href="/categories">Categories</a></li>
    </ul>
HTML;

        $response->getBody()->write($res);

        return $response;
    });

    //exo 1
    $app->get('/categories[/]', GetCategoriesAction::class);

    //exo 2
    $app->get('/categories/{id}[/]', GetCategorieIdAction::class);

    //exo 3
    $app->get('/prestation[/]', GetPrestationAction::class);

    //exo 4
    $app->get('/box/create[/]', GetBoxCreateAction::class);

    $app->post('/box/create[/]', PostBoxCreateAction::class);

    //TD3 exo2

    $app->get('/categories/{id}/pr  estations[/]', GetPrestatDeCategorieAction::class);

    return $app;

};