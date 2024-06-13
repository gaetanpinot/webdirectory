<?php

namespace web\api\core\services\entries;

interface AnnuaireServiceInterface
{
    public function getFonctionById(): Fonction;
    public function getPersonneById(): Personne;
    public function getServiceById(): Service;
}