<?php

namespace web\admin\core\services\entries;

use web\admin\core\domain\entities\Fonction;
use web\admin\core\domain\entities\Personne;
use web\admin\core\domain\entities\Service;

interface AnnuaireServiceInterface
{
    public function createService(array $data): int;


    public function getFonctionById(int $id): Fonction;

    public function getPersonneById(int $id): Personne;

    public function getServiceById(int $id): Service;

    public function getTelephoneByPersonne(int $idPers): array;

//   public function getPersonnesWithServices(): array;

}