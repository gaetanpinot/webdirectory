<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;

class GetPersonnesByService extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        try {
            $services = $annuaireService->getPersonnesByServices($args['id']);
            $data = compact('services');
//            var_dump($data);
            $dataAfterFiltering = ['services' => []];
            foreach ($data['services'] as $d) {
                $personnes = [];
                foreach ($d['personnes'] as $p) {
                    $personnes[] = [
                        'id' => $p['id'],
                        'nom' => $p['nom'],
                        'prenom' => $p['prenom'],
                        'links' => ['detail' => "/api/personnes/{$p['id']}"]
                    ];
                }
                $dataAfterFiltering['services'][] = [
                    'id' => $d['id'],
                    'libelle' => $d['libelle'],
                    'personnes' => $personnes

                ];
            }

            $jsonData = json_encode(['type' => 'resource', 'data' => $dataAfterFiltering]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (NotFoundAnnuaireException $e) {
            throw new HttpInternalServerErrorException($request, 'Internal Error');
        }
    }
}