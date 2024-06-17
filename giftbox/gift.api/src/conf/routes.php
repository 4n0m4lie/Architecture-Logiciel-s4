<?php
declare(strict_types=1);

use gift\api\app\actions\GetBoxAction;
use gift\api\app\actions\GetBoxByIdAction;
use gift\api\app\actions\GetCategorieIdAction;
use gift\api\app\actions\GetCategoriesAction;
use gift\api\app\actions\GetPrestatDeCategorieAction;
use gift\api\app\actions\GetPrestationAction;
use gift\api\app\actions\GetPrestationsAction;

return function( \Slim\App $app): \Slim\App {

    $app->get('/api/categories[/]', GetCategoriesAction::class)->setName('categories');

    $app->get('/api/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    $app->get('/api/categories/{id}/prestations[/]', GetPrestatDeCategorieAction::class)->setName('prestationsDeCategorie');

    //$app->get('/api/boxes[/]', GetBoxAction::class)->setName('box');

    $app->get('/api/boxes/{id}[/]', GetBoxByIdAction::class)->setName('boxId');

    $app->get('/api/categories/{id}[/]', GetCategorieIdAction::class)->setName('categorieId');

    $app->get('/api/prestations/{id}[/]', GetPrestationAction::class)->setName('prestation');

    return $app;

};