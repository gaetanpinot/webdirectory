<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;

class GetTelephonesByPersonne extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireServ = new AnnuaireService();

        try {
            $telephones = $annuaireServ->getTelephoneByPersonne($args['id']);

            $data = compact('telephones');
            $jsonData = json_encode(['type' => 'resource', 'data' => $data]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        }catch (\Exception $e){
            return $response->withStatus(500);
            //TODO EXCEPTION
        }
    }
}