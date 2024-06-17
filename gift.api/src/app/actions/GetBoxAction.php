<?php


namespace gift\api\app\actions;

use gift\api\core\service\BoxService;
use gift\api\core\service\Catalogue;
use gift\api\core\service\IBoxService;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\OrmException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;

class GetBoxAction extends AbstractAction
{
    private IBoxService $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {

        try {
            $box = $this->boxService->getBox();
        } catch (OrmException $e) {
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        $response->getBody()->write(json_encode($box));
        return $response->withHeader('Content-Type', 'application/json');
    }
}