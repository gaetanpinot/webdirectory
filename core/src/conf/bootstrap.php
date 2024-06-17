<?php

namespace web\api\conf;

use Slim\Factory\AppFactory;
use web\api\infrastructure\Eloquent;

Eloquent::init(__DIR__ . '/../conf/webdir.db.conf.ini.dist');

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

//CORS
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
$app = (require_once __DIR__ . '/../conf/routes.php')($app);

return ($app);