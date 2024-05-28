<?php
declare(strict_types=1);

use gift\appli\app\actions\GetBoxCreateAction;
use gift\appli\app\actions\GetCategorieIdAction;
use gift\appli\app\actions\GetCategoriesAction;
use gift\appli\app\actions\GetPrestatDeCategorieAction;
use gift\appli\app\actions\GetPrestationAction;
use gift\appli\app\actions\GetPrestationsAction;
use gift\appli\app\actions\PostBoxCreateAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;

return function( \Slim\App $app): \Slim\App {


    /* home */

    $app->get('/', function (Request $request, Response $response, array $args) {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueHome.twig');
    });

    //exo 1
    $app->get('/categories[/]', GetCategoriesAction::class)->setName('categories');

    //exo 2
    $app->get('/categories/{id}[/]', GetCategorieIdAction::class)->setName('categorieId');

    //exo 3
    $app->get('/prestation[/]', GetPrestationAction::class)->setName('prestation');

    //exo 4
    $app->get('/box/create[/]', GetBoxCreateAction::class)->setName('getBoxCreate');

    $app->post('/box/create[/]', PostBoxCreateAction::class)->setName('postBoxCreate');

    //TD3 exo2

    $app->get('/categories/{id}/prestations[/]', GetPrestatDeCategorieAction::class)->setName('prestationsDeCategorie');

    $app->get('/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    return $app;

};