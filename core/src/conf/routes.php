<?php
declare(strict_types=1);

namespace web\api\conf;

use Slim\App;
use web\api\app\actions\Racine;

return function (App $app): App {

    $app->get('[/]', Racine::class);

    return $app;
};