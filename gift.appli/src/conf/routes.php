<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function( \Slim\App $app): \Slim\App {
    /* home */

    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hello, welcome to the gift-appli API");
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



    return $app;

};