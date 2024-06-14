<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;

class PostServiceCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annService = new AnnuaireService();
        $view = Twig::fromRequest($request);

        $data = $request->getParsedBody();

        try {
            $annService->createService($data);
            return $response->withHeader('Location', '/')->withStatus(302);
        } catch (\Exception $e) {
            return $view->render($response, 'service_create.twig', [
                'error' => 'Failed to create service',
            ]);
        }
    }
}