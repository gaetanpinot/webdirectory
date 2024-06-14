<?php
declare(strict_types=1);

namespace web\admin\conf;

use Slim\App;


use web\admin\app\actions\GetLoginForm;
use web\admin\app\actions\GetLogout;
use web\admin\app\actions\GetPersonneCreate;
use web\admin\app\actions\GetServiceCreate;
use web\admin\app\actions\PostLogin;
use web\admin\app\actions\PostPersonneCreate;

use web\admin\app\actions\PostServiceCreate;
use web\admin\app\actions\Racine;
use web\admin\core\services\auth\Auth;

return function (App $app): App {

    $app->get('[/]', Racine::class);

    $app->get('/personne/create[/]', GetPersonneCreate::class)->add(Auth::class);
    $app->post('/personne/create[/]', PostPersonneCreate::class)->add(Auth::class);

    $app->get('/service/create[/]', GetServiceCreate::class)->add(Auth::class);
    $app->post('/service/create[/]', PostServiceCreate::class)->add(Auth::class);
    /*
    $app->get('/personnes[/]', GetAllPersonne::class);
    $app->get('/personnes/service/{id}[/]', GetPersonnesByService::class);
    */
    $app->get('/login[/]', GetLoginForm::class);
    $app->post('/login[/]', PostLogin::class);
    $app->get('/logout[/]', GetLogout::class);

    return $app;
};