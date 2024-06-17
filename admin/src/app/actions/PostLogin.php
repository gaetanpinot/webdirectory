<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\utils\CsrfException;
use web\admin\utils\CsrfToken;

class PostLogin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            CsrfToken::check($_POST['token']);
        } catch (CsrfException $e) {
            throw new HttpNotFoundException($request, "Questionnaire invalide");
        }
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