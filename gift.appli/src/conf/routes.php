<?php
declare(strict_types=1);

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


    //exo3
    $app-> get('/prestation',function(Request $request ,Response $a){
        $id=$request->getQueryParams();

        $trueId="1";
        $libelle="Champagne";
        $description="Bouteille de champagne + flutes + jeux à gratter";


        if ($id['id']==$trueId)
        {
            $aff = $libelle . "\n";
            $aff.= $description . "\n";
        }
        else
        {$aff = "ceci n'est pas un id valide";}
        $a->getBody()->write($aff);
        return $a;});


    //exo4
    $app->get('/box/create', function (Request $request, Response $response) {
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
        });

    $app->post('/box/create', function (Request $request, Response $response) {
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
        });



    $app->get('/categories', function (Request $request, Response $response, array $args) {
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
    });

    $app->get('/categories/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];
        $res = <<<HTML
    <h1>CATEGORIE $id</h1>
HTML;

        $response->getBody()->write($res);
        return $response;
    });

    return $app;

};