<?php

namespace web\api\app\actions;
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
            return $response->withJson($fonctions);

        }catch (\Exception $e){
            return $response->withStatus(500);
        }



    }
}