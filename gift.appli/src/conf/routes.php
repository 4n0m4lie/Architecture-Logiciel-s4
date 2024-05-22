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

    /*exo3:*/
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


    return $app;

};