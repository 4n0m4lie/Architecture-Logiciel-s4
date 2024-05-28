<?php

use gift\appli\infrastructure\Eloquent;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();

$twig = Twig::create(__DIR__ . '/../app/views', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));




$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, false, false);

$app= (require_once __DIR__ . '/routes.php')($app);

Eloquent::init('../src/conf/gift.db.conf.ini.dist');

return $app;