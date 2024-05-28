<?php


namespace gift\appli\app\actions;

use gift\appli\core\service\Catalogue;
use gift\appli\core\service\ICatalogue;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetCategoriesAction extends AbstractAction
{
    private ICatalogue $catalogue;
    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $i = 0;

        $categories = $this->catalogue->getCategories();
        /*
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
        */

        $view = Twig::fromRequest($request);
        return $view->render($response, 'VueCategories.twig', ['categories' => $categories]);
    }
}