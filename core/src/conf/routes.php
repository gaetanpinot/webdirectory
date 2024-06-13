<?php
declare(strict_types=1);

namespace web\api\conf;

use Slim\App;
use web\api\app\actions\GetFonction;
use web\api\app\actions\GetPersonne;
use web\api\app\actions\GetService;
use web\api\app\actions\GetTelephonesByPersonne;
use web\api\app\actions\Racine;

return function (App $app): App {

    $app->get('[/]', Racine::class);

    $app->get('/api[/]', Racine::class);

    $app->get('/api/services/{id}[/]', GetService::class);

    $app->get('/api/fonctions/{id}[/]', GetFonction::class);

    $app->get('/api/personnes/{id}[/]', GetPersonne::class);

    $app->get('/api/personnes/{id}/telephones[/]', GetTelephonesByPersonne::class);

    return $app;
};