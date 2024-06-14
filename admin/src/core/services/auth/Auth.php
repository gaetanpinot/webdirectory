<?php

namespace web\admin\core\services\auth;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

class Auth implements AuthInterface
{
    public function __invoke(Request $request, RequestHandler $handler): Response {
        $session = $request->getAttribute('session');

        if (!isset($session['user'])) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $response = new \Slim\Psr7\Response();
            return $response->withHeader('Location', $routeParser->urlFor('login'))
                ->withStatus(302);
        }

        return $handler->handle($request);
    }
}