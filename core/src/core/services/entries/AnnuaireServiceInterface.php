<?php

interface AnnuaireServiceInterface
{
    public function getFonctionById(): Fonction;
    public function getPersonneById(): Personne;
    public function getServiceById(): Service;
}