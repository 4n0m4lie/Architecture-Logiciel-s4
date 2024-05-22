<?php
declare(strict_types=1);


use Slim\Factory\AppFactory;

require_once __DIR__ . '/../src/vendor/autoload.php';


/* application boostrap */

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app->setBasePath('/archi-s4/gift.appli/public');

$app=(require_once __DIR__ . '/../src/conf/routes.php')($app);



$app->run();
