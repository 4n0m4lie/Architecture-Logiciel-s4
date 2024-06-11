<?php
declare(strict_types=1);

use gift\appli\app\actions\GetAuth;
use gift\appli\app\actions\GetBoxCreateAction;
use gift\appli\app\actions\GetBoxMenu;
use gift\appli\app\actions\GetBoxVisualisation;
use gift\appli\app\actions\GetPrestationsTrierAction;
use gift\appli\app\actions\GetPrestationsTrierAscAction;
use gift\appli\app\actions\GetPrestationsTrierDescAction;
use gift\appli\app\actions\GetCategorieCreateAction;
use gift\appli\app\actions\GetCategorieIdAction;
use gift\appli\app\actions\GetCategoriesAction;
use gift\appli\app\actions\GetLiaisonPrestationBoxAction;
use gift\appli\app\actions\GetLiaisonPrestationCategorieAction;
use gift\appli\app\actions\GetPrestatDeCategorieAction;
use gift\appli\app\actions\GetPrestationAction;
use gift\appli\app\actions\GetPrestationModifyAction;
use gift\appli\app\actions\GetPrestationsAction;
use gift\appli\app\actions\GetRegister;
use gift\appli\app\actions\PostAuth;
use gift\appli\app\actions\PostBoxCreateAction;
use gift\appli\app\actions\PostBoxVisualisation;
use gift\appli\app\actions\PostCategorieCreateAction;
use gift\appli\app\actions\PostLiaisonPrestationCategorieAction;
use gift\appli\app\actions\PostPrestationModifyAction;
use gift\appli\app\actions\PostRegister;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;

return function( \Slim\App $app): \Slim\App {


    /* home */

    $app->get('/', function (Request $request, Response $response, array $args) {

        $texte = "";
        //vérfier si l'utilisateur est connecté
        if(isset($_SESSION['user'])){
            $texte = ", ".$_SESSION['user']['login']." !";
        }else{
            $texte = ", connectez-vous !";
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueHome.twig', ['texte' => $texte]);
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

    $app->get('/categorie/create[/]', GetCategorieCreateAction::class)->setName('getCategorieCreate');

    $app->post('/categorie/create[/]', PostCategorieCreateAction::class)->setName('postCategorieCreate');

    $app->get('/prestation/modify[/]', GetPrestationModifyAction::class)->setName('getPrestationModify');

    $app->post('/prestation/modify[/]', PostPrestationModifyAction::class)->setName('postPrestationModify');

    $app->get('/LiaisonCatePresta[/]',GetLiaisonPrestationCategorieAction::class)->setName('getLiaisonPrestationCategorie');

    $app->post('/LiaisonCatePresta[/]',PostLiaisonPrestationCategorieAction::class)->setName('postLiaisonPrestationCategorie');


    $app->get('/LiaisonPrestaBox[/]',GetLiaisonPrestationBoxAction::class)->setName('getLiaisonPrestationBox');

    //$app->get('/LiaisonPrestaBox[/]',PostLiaisonPrestationBoxAction::class)->setName('postLiaisonPrestationBox');

    $app->get('/prestations/trierAsc[/]', GetPrestationsTrierAscAction::class)->setName('prestationsTrierAsc');
    $app->get('/prestations/trierDesc[/]', GetPrestationsTrierDescAction::class)->setName('prestationsTrierDesc');

    $app->get('/auth[/]', GetAuth::class)->setName('auth');

    $app->post('/auth[/]', PostAuth::class)->setName('postAuth');

    $app->get('/register[/]', GetRegister::class)->setName('register');

    $app->post('/register[/]', PostRegister::class)->setName('postRegister');

    $app->get('/boxMenu[/]', GetBoxMenu::class)->setName('boxMenu');

    $app->get('/boxVisualisation[/]', GetBoxVisualisation::class)->setName('boxVisualisation');

    $app->post('/boxVisualisation[/]', PostBoxVisualisation::class)->setName('boxVisualisation');

    return $app;

};