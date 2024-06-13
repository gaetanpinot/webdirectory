<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Exception\HttpNotFoundException;
use web\api\app\actions\AbstractAction;

class RacineHtml extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $index=__DIR__.'/../../../web/index.html';
//        $response->getBody()->write(fread(fopen($index,'r'),filesize($index)));
        try {
            $response->getBody()->write(file_get_contents($index));
        }catch (\Exception $e){
            throw new HttpInternalServerErrorException($request,"No index");
        }
        return($response);
    }
}