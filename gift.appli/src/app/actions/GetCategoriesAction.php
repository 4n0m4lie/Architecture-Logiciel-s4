<?php


namespace gift\appli\app\actions;

use gift\appli\models\Categorie;
use gift\appli\utils\Eloquent;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesAction extends AbstractAction{

    public function __invoke(Request $request, Response $response, array $args): Response {
        $i = 0;
        $categories = Categorie::all();
        foreach($categories as $categorie){
            $i++;
            $aff = $i .' - '. $categorie->libelle . "\n";
            $aff.= $categorie->description . "\n";
            $aff.= $categorie->tarif . "\n";
            $aff.= $categorie->unite . "\n";
        }
        $actualUrl = $request->getUri();

        $response->getBody()->write($aff);
        return $response;}}