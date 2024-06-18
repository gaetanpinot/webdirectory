<?php

namespace web\api\app\actions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;

class GetService extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireServ = new AnnuaireService();

        try {
            $service = $annuaireServ->getServiceById($args['id']);

            $data = compact('service');
            $data['service']['links'] = ['detail' => "/api/services/{$data['service']['id']}"];
//            $dataAfterFiltering=['service'=>[]];
//            foreach($data['service'] as $d){
//                $d['links']=['detail'=>"/api/services/{$d['id']}"];
//                $dataAfterFiltering['service'][]=$d;
//            }
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