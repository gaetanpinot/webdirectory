<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;
use web\admin\utils\CsrfException;
use web\admin\utils\CsrfToken;

class PostServiceCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            CsrfToken::check($_POST['token']);
        } catch (CsrfException $e) {
            throw new HttpNotFoundException($request, "Questionnaire invalide");
        }
        $champsCreateService = [];
        $champsCreateService['libelle'] = filter_var($_POST['libelle'], FILTER_SANITIZE_SPECIAL_CHARS);
        $champsCreateService['description'] = filter_var($_POST['description']);
        $champsCreateService['etage'] = filter_var($_POST['etage'], FILTER_SANITIZE_NUMBER_INT);

        $cle = array_keys($champsCreateService);
        foreach ($cle as $c) {
            $champs = $champsCreateService[$c];
            if (!isset($champs)) {
                throw new HttpNotFoundException($request, "Valeur $c non renseignée");
            }
            if ($champs != $_POST[$c]) {
                throw new HttpNotFoundException($request, "Valeur $c non valide");
            }
        }

        $annuaire = new AnnuaireService();

        try {
            $service = $annuaire->createService($champsCreateService);
        } catch (NotFoundAnnuaireException $exception) {
            throw new HttpNotFoundException($request, $exception->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'PostCreerService.twig', ['id' => $service]);
    }
}