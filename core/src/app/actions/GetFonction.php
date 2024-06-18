<?php

namespace web\api\app\actions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;

class GetFonction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireServ = new AnnuaireService();

        try {
            $fonctions = $annuaireServ->getFonctionById($args['id']);

            $data = compact('fonctions');
            $jsonData = json_encode(['type' => 'resource', 'data' => $data]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (Exception $e) {
            return $response->withStatus(500);
        }
    }
}