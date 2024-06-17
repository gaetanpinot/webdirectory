<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;

class PostCreateAdmin extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        if (!$_SESSION['user']['is_super_admin']) {
            throw new HttpNotFoundException($request, 'Vous devez être superAdmin pour créer un admin');
        }

        $newAdminData['username'] = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
        if ($newAdminData['username'] != $_POST['username']) {
            throw new HttpNotFoundException($request, 'Username non valide');
        }
        $newAdminData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $annuaire = new AnnuaireService();
        try {
            $annuaire->createAdmin($newAdminData);
        } catch (NotFoundAnnuaireException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        return $response->withStatus(302)->withHeader('Location', "/");
    }
}