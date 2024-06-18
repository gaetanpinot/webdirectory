<?php

namespace web\api\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use web\api\core\services\entries\AnnuaireService;
use web\api\core\services\NotFoundAnnuaireException;

class GetPersonne extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaireServ = new AnnuaireService();

        try {
            $personne = $annuaireServ->getPersonneById($args['id']);

            $data = compact('personne');
//            var_dump($data);

            $dataAfterFiltering = ['personne' => []];
            $e = $data['personne'];
            $service = [];

            foreach ($e['service'] as $s) {
                $service[] = [
                    'id' => $s['id'],
                    'libelle' => $s['libelle'],
                    'links' => ['detail' => "/api/services/{$s['id']}"]
                ];
            }

            $telephones = [];
            foreach ($e['telephone'] as $t) {
                $telephones[] = $t['num'];
            }
            $fonctions = [];
            foreach ($e['fonction'] as $f) {
                $fonctions[] = [
                    'id' => $f['id'],
                    'libelle' => $f['libelle']
                ];
            }
            $dataAfterFiltering['personne'] = [
                'id' => $e['id'],
                'nom' => $e['nom'],
                'prenom' => $e['prenom'],
                'mail' => $e['mail'],
                'num_bureau' => $e['num_bureau'],
                'url_img' => $e['url_img'],
                'service' => $service,
                'telephones' => $telephones,
                'fonctions' => $fonctions,

            ];


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