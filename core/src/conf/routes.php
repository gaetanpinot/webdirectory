<?php
declare(strict_types=1);


return function (\Slim\App $app): \Slim\App {

    $app->get('[/]', Racine::class);



    return $app;
};