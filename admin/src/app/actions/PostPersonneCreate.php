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

class PostPersonneCreate extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            CsrfToken::check($_POST['token']);
        } catch (CsrfException $e) {
            throw new HttpNotFoundException($request, "Questionnaire invalide");
        }
        $champsCreatePersonne = [];
        $champsCreatePersonne['nom'] = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $champsCreatePersonne['prenom'] = filter_var($_POST['prenom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $champsCreatePersonne['mail'] = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $champsCreatePersonne['num_bureau'] = filter_var($_POST['num_bureau'], FILTER_SANITIZE_NUMBER_INT);
        $champsCreatePersonne['url_img'] = filter_var($_POST['url_img'], FILTER_SANITIZE_URL);
        $champsCreatePersonne['id_service'] = filter_var($_POST['id_service'], FILTER_SANITIZE_NUMBER_INT);
        $cle = array_keys($champsCreatePersonne);
        foreach ($cle as $c) {
            $champs = $champsCreatePersonne[$c];
            if (!isset($champs)) {
                throw new HttpNotFoundException($request, "Valeur $c non renseignée");
            }
            if ($champs != $_POST[$c]) {
                throw new HttpNotFoundException($request, "Valeur $c non valide");
            }
        }

        $annuaire = new AnnuaireService();

        try {
            $idPerso = $annuaire->createPersonneWithService($champsCreatePersonne);
        } catch (NotFoundAnnuaireException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }

        $view = Twig::fromRequest($request);
        return $view->render($response, 'personneCreee.twig', ['id' => $idPerso]);
    }
}