<?php
declare(strict_types=1);

namespace web\admin\conf;

use Slim\App;

use web\admin\app\actions\GetCreateAdmin;
use web\admin\app\actions\GetPersonneCreate;
use web\admin\app\actions\GetServiceCreate;
use web\admin\app\actions\PostCreateAdmin;
use web\admin\app\actions\PostPersonneCreate;
use web\admin\app\actions\PostServiceCreate;
use web\admin\app\actions\Racine;
use web\admin\app\actions\GetAllPersonne;


return function (App $app): App {

    $app->get('[/]', Racine::class)->setName('racine');

    $app->get('/personne/create[/]', GetPersonneCreate::class)->setName('createPersonne');
    $app->post('/personne/create[/]', PostPersonneCreate::class);
//    ->add(AuthMiddleware::class);

    $app->get('/admin/create[/]',GetCreateAdmin::class)->setName('createAdmin');
    $app->post('/admin/create[/]',PostCreateAdmin::class);

    $app->get('/service/create[/]', GetServiceCreate::class)->setName('createService');
    $app->post('/service/create[/]', PostServiceCreate::class);
//    ->add(AuthMiddleware::class);

    $app->get('/personnes[/]', GetAllPersonne::class);
    $app->get('/personnes/service/{id}[/]', GetPersonnesByService::class);

    $app->get('/login[/]', LoginForm::class);
    $app->post('/login[/]', Login::class);

    return $app;
};