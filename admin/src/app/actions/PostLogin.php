<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;

class PostLogin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $anService = new AnnuaireService();
        $twig = Twig::fromRequest($request);

        $data = $request->getParsedBody();
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        //validation des données
        if ($anService->adminLogin($username, $password)) {

            // redirection
            return $twig->render($response, 'AuthOk.twig');
        } else {
            // erreur d'authentification
            return $twig->render($response, 'login.twig', [
                'error' => 'Invalid username or password',
            ]);
        }
    }
}