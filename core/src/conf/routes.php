<?php
declare(strict_types=1);

namespace web\api\conf;

use Slim\App;
use Slim\Exception\HttpNotFoundException;
use web\api\app\actions\GetAllFonction;
use web\api\app\actions\GetAllPersonne;
use web\api\app\actions\GetAllService;
use web\api\app\actions\GetFonction;
use web\api\app\actions\GetPersonne;
use web\api\app\actions\GetPersonneByName;
use web\api\app\actions\GetPersonneByService;
use web\api\app\actions\GetService;
use web\api\app\actions\GetTelephonesByPersonne;
use web\api\app\actions\Racine;
use web\api\app\actions\RacineHtml;


return function (App $app): App {


    $app->get('/api[/]', Racine::class);

    $app->get('/api/services/{id}[/]', GetService::class);

    $app->get('/api/services/{id}/personnes[/]', GetPersonneByService::class);

    $app->get('/api/services[/]', GetAllService::class);

    $app->get('/api/fonctions/{id}[/]', GetFonction::class);

    $app->get('/api/fonctions[/]', GetAllFonction::class);

    $app->get('/api/personnes/search[/]', GetPersonneByName::class);

    $app->get('/api/personnes/{id}[/]', GetPersonne::class);

    $app->get('/api/personnes[/]', GetAllPersonne::class);

    $app->get('/api/personnes/{id}/telephones[/]', GetTelephonesByPersonne::class);

    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new HttpNotFoundException($request);
    });

    return $app;
};