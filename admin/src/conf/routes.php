<?php
declare(strict_types=1);

namespace web\admin\conf;

use Slim\App;

use web\admin\app\actions\GetPersonneCreate;
use web\admin\app\actions\GetServiceCreate;
use web\admin\app\actions\PostPersonneCreate;
use web\admin\app\actions\PostServiceCreate;
use web\admin\app\actions\Racine;


return function (App $app): App {

    $app->get('[/]', Racine::class);

    $app->get('/personne/create[/]', GetPersonneCreate::class);
    $app->post('/personne/create[/]', PostPersonneCreate::class);
//    ->add(AuthMiddleware::class);

    $app->get('/service/create[/]', GetServiceCreate::class);
    $app->post('/service/create[/]', PostServiceCreate::class);
//    ->add(AuthMiddleware::class);

    $app->get('/personnes[/]', GetAllPersonne::class);
    $app->get('/personnes/service/{id}[/]', GetPersonnesByService::class);

    $app->get('/login[/]', LoginForm::class);
    $app->post('/login[/]', Login::class);

    return $app;
};