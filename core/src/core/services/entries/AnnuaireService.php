<?php

namespace web\api\core\services\entries;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use web\api\core\domain\entities\Fonction;
use web\api\core\domain\entities\Personne;
use web\api\core\domain\entities\Service;

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

            $fonction = Fonction::find($id);

            if (!$fonction) throw new ModelNotFoundException();

            return $fonction;

        } catch (ModelNotFoundException $e) {
//            throw new AnnuaireServiceNotFoundException("Erreur interne", 500);
            //TODO Exception
        }
    }

    public function getServiceById(int $id): Service
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

    public function getTelephoneByPersonne(int $idPers): array
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
}