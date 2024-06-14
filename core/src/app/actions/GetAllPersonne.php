<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use web\api\core\services\entries\AnnuaireService;
use web\api\core\services\NotFoundAnnuaireException;

class GetAllPersonne extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireService = new AnnuaireService();
        $sort='';
        if(isset($_GET['sort'])){
            $sort=$_GET['sort'];
        }
        try {
            $personnes = $annuaireService->getPersonnesWithServices($sort);
            $data = compact('personnes');
            $dataAfterFiltering = ['personnes'=>[]];
            foreach ($data['personnes'] as $e) {
                $service=[];
                foreach($e['service'] as $s){
                    $service[]=[
                        'id'=>$s['id'],
                        'libelle'=>$s['libelle'],
                        'links'=>['detail'=>"/api/services/{$s['id']}"]
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