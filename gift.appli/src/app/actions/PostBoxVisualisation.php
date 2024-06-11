<?php

namespace gift\appli\app\actions;

use gift\appli\core\service\BoxService;
use gift\appli\core\service\IBoxService;
use gift\appli\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\Twig;

class PostBoxVisualisation extends AbstractAction{

    private IBoxService $boxService;

    public function __construct(){
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();

        $data['id'];

        if(isset($data['adj'])) {
            $idBox = $_SESSION['Box']['id'];
            $idPrestation = $data['id'];
            try{
                $this->boxService->boxAddPrestation( $idPrestation, $idBox);
            }catch (OrmException $e) {
                throw new HttpBadRequestException($request, $e->getMessage());
            }
        }elseif (isset($data['supp'])) {
            $idBox = $_SESSION['Box']['id'];
            $idPrestation = $data['id'];
            try{
                $this->boxService->boxSupprPrestation( $idPrestation, $idBox);
            }catch (OrmException $e) {
                throw new HttpBadRequestException($request, $e->getMessage());
            }
        }elseif (isset($data['ret'])) {
            $idBox = $_SESSION['Box']['id'];
            $idPrestation = $data['id'];
            try{
                $this->boxService->boxRemovePrestation( $idPrestation, $idBox);
            }catch (OrmException $e) {
                throw new HttpBadRequestException($request, $e->getMessage());
            }
        }else{
            var_dump("rien");
        }

        return $response->withHeader('Location', '/boxVisualisation/')->withStatus(302);
    }
}