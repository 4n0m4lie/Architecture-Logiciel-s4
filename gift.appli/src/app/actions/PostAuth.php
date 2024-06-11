<?php

namespace gift\appli\app\actions;

use gift\appli\app\utils\CsrfException;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\service\Catalogue;
use gift\appli\core\service\ICatalogue;
use gift\appli\core\service\IUserService;
use gift\appli\core\service\OrmException;
use gift\appli\core\service\UserService;
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