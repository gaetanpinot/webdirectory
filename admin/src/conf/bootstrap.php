<?php

namespace web\api\conf;

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use web\admin\infrastructure\Eloquent;

session_start();

Eloquent::init(__DIR__ . '/../conf/webdir.db.conf.ini.dist');

$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app = (require_once __DIR__ . '/../conf/routes.php')($app);
$twig = Twig::create(__DIR__ . '/../app/views',
    ['cache' => __DIR__ . '/../cache',
        'auto_reload' => true]);

$app->add(TwigMiddleware::create($app, $twig));


return ($app);