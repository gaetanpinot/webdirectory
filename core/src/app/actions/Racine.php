<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
class Racine extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $data = ['message' => 'API Welcome'];
            $jsonData = json_encode(['type' => 'message', 'data' => $data]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }
        catch (\Exception $e){
            return $response->withStatus(500);
        }
    }
}