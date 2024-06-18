<?php

namespace web\api\core\services\entries;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use web\api\core\domain\entities\Fonction;
use web\api\core\domain\entities\Personne;
use web\api\core\domain\entities\Service;
use web\api\core\services\NotFoundAnnuaireException;

class AnnuaireService implements AnnuaireServiceInterface
{
    public function getFonctionById(int $id): Fonction
    {
        try {

            $fonction = Fonction::find($id);

            if (!$fonction) throw new ModelNotFoundException();

            return $fonction;

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Fonction introuvable');
        }
    }

    public function getPersonneById(int $id, $publie = true): array
    {
        try {
            $personne = Personne::where('id', '=', $id)->with('service','fonction','telephone');
            if ($publie) {
                $personne = $personne->where('publie', '=', true);
            }
            $personne = $personne->get();

            if (!$personne) throw new NotFoundAnnuaireException('Personne non existante ou non publié');
            if (count($personne) == 0) throw new NotFoundAnnuaireException('Personne non existante ou non publié');

            return $personne->toArray()[0];

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }

    public function getServiceById(int $id): Service
    {
        try {

            $service = Service::find($id);

            if (!$service) throw new ModelNotFoundException();

//            var_dump($service);
            return $service;

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Service introuvable');
        }
    }

    public function getTelephoneByPersonne(int $idPers): array
    {
        try {

            $telephones = Personne::find($idPers)->telephone;

            if (!$telephones) throw new ModelNotFoundException();

            return $telephones->toArray();

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }

    public function getServices()
    {
        try {
            $services = Service::get();

            return ($services->toArray());

        } catch (QueryException $e) {

            throw new NotFoundAnnuaireException('Erreur de base donnée');

        }
    }

    public function getFonctions()
    {
        try {
            $fonction = Fonction::get();

            return $fonction->toArray();
        } catch (QueryException $e) {

            throw new NotFoundAnnuaireException('Erreur de base de donnée');
        }
    }

    public function getPersonnesWithServices($order = "", $publie = true): array
    {
        try {
            $personnes = Personne::with('service');
            if ($publie) {
                $personnes = $personnes->where('publie', '=', true);
            }
            switch ($order) {
                case 'nom-desc':
                    $personnes->orderByDesc('nom');
                    break;
                case 'nom-asc':
                    $personnes->orderBy('nom');
                    break;
                default:
                    break;

            }
            $personnes = $personnes->get();
            return $personnes->toArray();
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Erreur de base de donnée');
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }


    public function getPersonnesByServices(mixed $id, $publie = true)
    {
        try {
            $personnes = Service::where('id', '=', $id)->with('personnes.service');

            if ($publie) {
                $personnes->whereHas('personnes', function ($query) {
                    $query->where('publie', '=', true);
                });
            }
            $personnes = $personnes->get();

            return $personnes->toArray();
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Erreur de base de donnée');
        } catch (ModelNotFoundException $e) {

            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }

    public function getPersonnesContainName(string $name, $publie = true)
    {
        try {
            $personnes = Personne::where('nom', 'like', '%' . $name . '%');
            if ($publie) {
                $personnes = $personnes->where('publie', '=', true);
            }
            return $personnes->get()->toArray();
        } catch (QueryException $e) {

            throw new NotFoundAnnuaireException('Erreur de base de donnée');
        } catch (ModelNotFoundException $e) {

            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }
}