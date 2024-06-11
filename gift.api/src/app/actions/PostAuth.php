<?php

namespace gift\api\app\actions;

use gift\api\app\utils\CsrfException;
use gift\api\app\utils\CsrfService;
use gift\api\core\service\Catalogue;
use gift\api\core\service\ICatalogue;
use gift\api\core\service\IUserService;
use gift\api\core\service\OrmException;
use gift\api\core\service\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

class PostAuth extends AbstractAction{

    private IUserService $userService;
    public function __construct(){
        $this->userService = new UserService();
    }
    public function __invoke(Request $request, Response $response, array $args): Response{

        $body = $request->getParsedBody();

        if(empty($body['login'])){
            throw new HttpBadRequestException($request, "login is required");
        }
        if (empty($body['password'])){
            throw new HttpBadRequestException($request, "password is required");
        }

        try {
            $a = $this->userService->checkUser($body);
        }catch (OrmException $e){
            throw new HttpBadRequestException($request, $e->getMessage());
        }

        if(!$a){
            throw new HttpBadRequestException($request, "login or password is incorrect");
        }

        return $response->withHeader('Location', '/')->withStatus(302);
    }
}