<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;
use web\api\core\services\NotFoundAnnuaireException;

class GetPersonneByName extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        $queryParams = $request->getQueryParams();
        $searchQuery = $queryParams['q'] ?? '';

        try {
            $personnes = $annuaireService->getPersonnesContainName($searchQuery);
            $data = compact('personnes');
            $dataAfterFiltering = ['personnes' => []];
            foreach ($data['personnes'] as $e) {
                $service = [];
                foreach ($e['service'] as $s) {
                    $service[] = [
                        'id' => $s['id'],
                        'libelle' => $s['libelle'],
                        'links' => ['detail' => "/api/services/{$s['id']}"]
                    ];
                }
                $dataAfterFiltering['personnes'][] = [
                    'id' => $e['id'],
                    'nom' => $e['nom'],
                    'prenom' => $e['prenom'],
                    'url_img' => $e['url_img'],
                    'services' => $service,
                    'links' => ['detail' => "/api/personnes/{$e['id']}"]

                ];


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