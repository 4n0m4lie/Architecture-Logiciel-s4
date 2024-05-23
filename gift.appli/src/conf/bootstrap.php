<?php

use gift\appli\utils\Eloquent;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, false, false);

$app->setBasePath('/archi-s4/gift.appli/public');

$app= (require_once __DIR__ . '/routes.php')($app);

Eloquent::init('../src/conf/gift.db.conf.ini.dist');

return $app;