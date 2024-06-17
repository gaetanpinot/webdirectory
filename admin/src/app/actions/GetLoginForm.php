<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use web\admin\utils\CsrfToken;

class GetLoginForm extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $token = CsrfToken::generate();
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'login.twig', ['token' => $token]);
    }
}