<?php

namespace web\api\core\services\entries;
use web\api\core\domain\entities\Fonction;
use web\api\core\domain\entities\Personne;
use web\api\core\domain\entities\Service;
interface AnnuaireServiceInterface
{
    public function getFonctionById(int $id): Fonction;
    public function getPersonneById(int $id): Personne;
    public function getServiceById(int $id): Service;
    public function getTelephoneByPersonne(int $idPers): array;

}