<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use web\admin\utils\CsrfToken;

class GetCreateAdmin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $token = CsrfToken::generate();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'GetCreerAdmin.twig', ['token' => $token]);
    }
}