<?php


Eloquent::init(__DIR__ . '/../conf/gift.db.conf.ini.dist');


$app = AppFactory::create();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app=(require_once __DIR__ . '/../conf/routes.php')($app);

$twig=Twig::create(__DIR__.'/../templates',
    ['cache'=>__DIR__.'/../cache',
        'auto_reload'=> true]);

$app->add(TwigMiddleware::create($app,$twig));


return($app);