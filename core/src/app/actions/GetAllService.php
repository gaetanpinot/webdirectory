<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;
use web\api\core\services\NotFoundAnnuaireException;

class GetAllService extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        try {
            $services = $annuaireService->getServices();
            $data = compact('services');

            $dataAfterFiltering = ['services' => []];
            foreach ($data['services'] as $d) {
                $d['links'] = ['detail' => "/api/services/{$d['id']}"];
                $dataAfterFiltering['services'][] = $d;
            }
            $jsonData = json_encode(['type' => 'resource', 'data' => $dataAfterFiltering]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (NotFoundAnnuaireException $e) {
            return $response->withStatus(500);
        }
    }
}