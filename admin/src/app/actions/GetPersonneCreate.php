<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;

class GetPersonneCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaire = new AnnuaireService();
        $services = $annuaire->getServices();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'createPersonneFormulaire.twig', compact('services'));
    }
}