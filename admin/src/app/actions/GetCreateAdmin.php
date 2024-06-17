<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class GetCreateAdmin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $view = Twig::fromRequest($request);
        return $view->render($response, 'GetCreerAdmin.twig');
    }
}