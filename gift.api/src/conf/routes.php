<?php
declare(strict_types=1);

use gift\api\app\actions\GetAuth;
use gift\api\app\actions\GetBoxCreateAction;
use gift\api\app\actions\GetCategorieCreateAction;
use gift\api\app\actions\GetCategorieIdAction;
use gift\api\app\actions\GetCategoriesAction;
use gift\api\app\actions\GetLiaisonPrestationBoxAction;
use gift\api\app\actions\GetLiaisonPrestationCategorieAction;
use gift\api\app\actions\GetPrestatDeCategorieAction;
use gift\api\app\actions\GetPrestationAction;
use gift\api\app\actions\GetPrestationModifyAction;
use gift\api\app\actions\GetPrestationsAction;
use gift\api\app\actions\GetRegister;
use gift\api\app\actions\PostAuth;
use gift\api\app\actions\PostBoxCreateAction;
use gift\api\app\actions\PostCategorieCreateAction;
use gift\api\app\actions\PostLiaisonPrestationCategorieAction;
use gift\api\app\actions\PostPrestationModifyAction;
use gift\api\app\actions\PostRegister;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;

return function( \Slim\App $app): \Slim\App {


    /* home */

   /* $app->get('/', function (Request $request, Response $response, array $args) {

        return $response->withStatus(200)
        
    });*/

    $app->get('/api/categories[/]', GetCategoriesAction::class)->setName('categories');

    $app->get('/api/categories/{id}[/]', GetCategorieIdAction::class)->setName('categorieId');

    $app->get('/api/prestation[/]', GetPrestationAction::class)->setName('prestation');

    $app->post('/api/box/create[/]', PostBoxCreateAction::class)->setName('postBoxCreate');

    $app->get('/api/categories/{id}/prestations[/]', GetPrestatDeCategorieAction::class)->setName('prestationsDeCategorie');
/*
    $app->get('/prestations[/]', GetPrestationsAction::class)->setName('prestations');

    $app->get('/categorie/create[/]', GetCategorieCreateAction::class)->setName('getCategorieCreate');

    $app->post('/categorie/create[/]', PostCategorieCreateAction::class)->setName('postCategorieCreate');

    $app->get('/prestation/modify[/]', GetPrestationModifyAction::class)->setName('getPrestationModify');

    $app->post('/prestation/modify[/]', PostPrestationModifyAction::class)->setName('postPrestationModify');

    $app->get('/LiaisonCatePresta[/]',GetLiaisonPrestationCategorieAction::class)->setName('getLiaisonPrestationCategorie');

    $app->post('/LiaisonCatePresta[/]',PostLiaisonPrestationCategorieAction::class)->setName('postLiaisonPrestationCategorie');

    $app->get('/LiaisonPrestaBox[/]',GetLiaisonPrestationBoxAction::class)->setName('getLiaisonPrestationBox');

    //$app->get('/LiaisonPrestaBox[/]',PostLiaisonPrestationBoxAction::class)->setName('postLiaisonPrestationBox');

    $app->get('/auth[/]', GetAuth::class)->setName('auth');

    $app->post('/auth[/]', PostAuth::class)->setName('postAuth');

    $app->get('/register[/]', GetRegister::class)->setName('register');

    $app->post('/register[/]', PostRegister::class)->setName('postRegister');
*/

    return $app;

};