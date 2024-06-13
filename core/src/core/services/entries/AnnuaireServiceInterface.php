<?php

namespace web\api\core\services\entries;

interface AnnuaireServiceInterface
{
    public function getFonctionById(int $id): Fonction;
    public function getPersonneById(int $id): Personne;
    public function getServiceById(int $id): Service;
    public function getTelephoneByPersonne(int $id): array;
}