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
        $aff = "<ul>";
        foreach($categories as $categorie){
            $i++;
            $aff.= "<li>";
            $aff.= "<a href='/categories/$categorie->id'>". $categorie->id .' - '. $categorie->libelle . "</a> ";
            $aff.= $categorie->description . " ";
            $aff.= "</li>";
        }
        $aff .= "</ul>";

        $res = <<<HTML
{$aff}
HTML;
        $response->getBody()->write($res);
        return $response;}}