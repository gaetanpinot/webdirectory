<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;

class GetAllPersonne extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        try {
            $personnes = $annuaireService->getPersonnesWithServices();
            $data = compact('personnes');
            $dataAfterFiltering = ['personnes'=>[]];
            foreach ($data['personnes'] as $e) {
                $service=[];
                foreach($e['service'] as $s){
                    $service[]=[
                        'id'=>$s['id'],
                        'libelle'=>$s['libelle']
                    ];
                }
                $dataAfterFiltering['personnes'][] = [
                    'id' => $e['id'],
                    'nom' => $e['nom'],
                    'prenom'=>$e['prenom'],
                    'service'=>$service,
                    'links'=>['detail'=>"/api/personnes/{$e['id']}"]

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