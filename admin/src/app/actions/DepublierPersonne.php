<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;

class DepublierPersonne extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaire = new AnnuaireService();
        try {
            $annuaire->depublier($args['id']);
        } catch (NotFoundAnnuaireException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
        return $response->withStatus(302)->withHeader('Location', "/personnes");
    }
}