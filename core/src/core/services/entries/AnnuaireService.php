<?php

namespace web\api\core\services\entries;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use web\api\core\domain\entities\Fonction;
use web\api\core\domain\entities\Personne;
use web\api\core\domain\entities\Service;
use web\api\core\domain\entities\Telephone;

class AnnuaireService implements AnnuaireServiceInterface
{
    public function getFonctionById(int $id): Fonction
    {
        try {

            $fonction = Fonction::find($id);

            if (!$fonction) throw new ModelNotFoundException();

            return $fonction;

        } catch (ModelNotFoundException $e) {
//            throw new AnnuaireServiceNotFoundException("Erreur interne", 500);
            //TODO Exception
        }
    }

    public function getPersonneById(int $id): Personne
    {
        try {

            $personne = Personne::find($id);

            if (!$personne) throw new ModelNotFoundException();

            return $personne;

        } catch (ModelNotFoundException $e) {
//            throw new AnnuaireServiceNotFoundException("Erreur interne", 500);
            //TODO Exception
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
//            throw new AnnuaireServiceNotFoundException("Erreur interne", 500);
            //TODO Exception
        }
    }

    public function getTelephoneByPersonne(int $idPers): array
    {
        try {

            $telephones = Personne::find($idPers)->telephone;

            if (!$telephones) throw new ModelNotFoundException();

            return $telephones->toArray();

        } catch (ModelNotFoundException $e) {
//            throw new AnnuaireServiceNotFoundException("Erreur interne", 500);
            //TODO Exception
        }
    }
}