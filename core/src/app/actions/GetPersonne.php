<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use web\admin\core\services\NotFoundAnnuaireException;
use web\api\core\services\entries\AnnuaireService;

class GetPersonne extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireServ = new AnnuaireService();

        try {
            $personne = $annuaireServ->getPersonneById($args['id']);
            $personne = $personne[0];

            $data = compact('personne');
//            var_dump($data);

            $dataAfterFiltering = ['personne' => []];
            $e = $data['personne'];
            $service = [];
            $s = $e['service'][0];

            $service = [
                'id' => $s['id'],
                'libelle' => $s['libelle'],
                'links' => ['detail' => "/api/services/{$s['id']}"]
            ];

            $dataAfterFiltering['personne'] = [
                'id' => $e['id'],
                'nom' => $e['nom'],
                'prenom' => $e['prenom'],
                'mail' => $e['mail'],
                'num_bureau' => $e['num_bureau'],
                'url_img' => $e['url_img'],
                'service' => $service,

            ];


            $jsonData = json_encode(['type' => 'resource', 'data' => $dataAfterFiltering]);
            $response->getBody()->write($jsonData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);

        } catch (NotFoundAnnuaireException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
    }
}