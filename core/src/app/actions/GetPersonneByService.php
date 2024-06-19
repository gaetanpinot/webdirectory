<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;
use web\api\core\services\NotFoundAnnuaireException;

class GetPersonneByService extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        try {
            if(isset($_GET['search-name'])){
                $search=$_GET['search-name'];
//                var_dump($search);
            }else{
                $search='';
            }
            $services = $annuaireService->getPersonnesByServices($args['id'],search:$search);
            $data = compact('services');
//            var_dump($data);
            $dataAfterFiltering = ['services' => []];
            foreach ($data['services'] as $d) {
                $personnes = [];
                foreach ($d['personnes'] as $p) {
                    $service = [];

                    foreach ($p['service'] as $s) {
                        $service[] = [
                            'id' => $s['id'],
                            'libelle' => $s['libelle'],
                            'links' => ['detail' => "/api/services/{$s['id']}"]
                        ];
                    }
                    $personnes[] = [
                        'id' => $p['id'],
                        'nom' => $p['nom'],
                        'prenom' => $p['prenom'],
                        'services'=>$service,
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
            return $response->withStatus(500);
        }
    }
}