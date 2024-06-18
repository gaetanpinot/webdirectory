<?php

namespace web\admin\core\services\auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class Auth implements AuthInterface
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        if (!isset($_SESSION['user'])) {
            $twig = Twig::fromRequest($request);

            return $twig->render(new Response(), "LogInNeeded.twig");
        }

        return $handler->handle($request);
    }
}