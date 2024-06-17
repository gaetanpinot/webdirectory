<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;
use web\admin\utils\CsrfToken;

class GetPersonneCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $token = CsrfToken::generate();
        $annuaire = new AnnuaireService();
        try {
            $services = $annuaire->getServices();
        } catch (NotFoundAnnuaireException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'createPersonneFormulaire.twig', ['services' => $services, 'token' => $token]);
    }
}