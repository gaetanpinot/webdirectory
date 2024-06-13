<?php

namespace web\api\conf;

use Slim\Factory\AppFactory;
use web\api\infrastructure\Eloquent;

Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini.dist');

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app=(require_once __DIR__ . '/../conf/routes.php')($app);

return($app);