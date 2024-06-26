<?php

namespace web\admin\core\services\entries;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use web\admin\core\domain\entities\Admin;
use web\admin\core\domain\entities\Fonction;
use web\admin\core\domain\entities\Personne;
use web\admin\core\domain\entities\Service;
use web\admin\core\services\NotFoundAnnuaireException;

class AnnuaireService implements AnnuaireServiceInterface
{
    public function adminLogin(string $name, string $password): bool
    {
        $admin = Admin::where('username', '=', $name)->first();
        if ($admin && password_verify($password, $admin->password)) {
            $_SESSION['user'] = [
                'username' => $admin->username,
                'is_super_admin' => $admin->is_super_admin,
            ];
            return true;
        }
        return false;
    }

    public function getFonctionById(int $id): Fonction
    {
        try {

            $fonction = Fonction::findOrFail($id);

            if (!$fonction) throw new ModelNotFoundException();

            return $fonction;

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Fonction introuvable');
        }
    }

    public function getPersonneById(int $id): Personne
    {
        try {

            $personne = Personne::findOrFail($id);

            if (!$personne) throw new ModelNotFoundException();

            return $personne;

        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Personne introuvable');
        }
    }

    public function getServiceById(int $id): Service
    {
        try {

            $service = Service::findOrFail($id);

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

            $telephones = Personne::findOrFail($idPers)->telephone;

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
            throw new NotFoundAnnuaireException('Erreur de base de donnée');
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

    public function getPersonnesWithServices($sort = '', $filterLibelleService = "")
    {

        try {
            if ($filterLibelleService != '') {
                $personnes = Personne::whereHas('service', function ($query) use ($filterLibelleService) {
                    $query->where('id', '=', $filterLibelleService);
                })->with('service');
            } else {
                $personnes = Personne::with('service');
            }

            switch ($sort) {
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
            throw new NotFoundAnnuaireException('Erreur de base donnée');
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException("Personne non trouvé");
        }
    }


    public function getPersonnesByServices(mixed $id)
    {
        try {
            $personnes = Service::where('id', '=', $id)->with('personnes')->get();
            return $personnes->toArray();
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Erreur de base donnée');
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException("Service not found");
        }
    }

    public function getPersonnesContainName(string $name)
    {
        try {
            $personnes = Personne::where('nom', 'like', '%' . $name . '%')->get();
            return $personnes->toArray();
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Erreur de base donnée');
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException("Personne not found");
        }
    }

    public function createPersonneWithService(array $p): int
    {
        try {
            $perso = new Personne();
            $perso->nom = $p['nom'];
            $perso->prenom = $p['prenom'];
            $perso->mail = $p['mail'];
            $perso->num_bureau = $p['num_bureau'];
            $perso->url_img = $p['url_img'];
            $perso->publie = true;
            $service = Service::find($p['id_service']);
            $service->personnes()->save($perso);
            return $perso->id;
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Insertion error');
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException('Service invalide');
        }
    }

    public function createService(array $champsCreateService): int
    {
        try {
            $service = new Service();
            $service->libelle = $champsCreateService['libelle'];
            $service->description = $champsCreateService['description'];
            $service->etage = $champsCreateService['etage'];
            $service->save();
            return $service->id;
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException('Insertion error');
        }
    }

    public function publier($idPersonne)
    {
        try {
            $personne = Personne::findOrFail($idPersonne);
            $personne->publie = true;
            $personne->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException("Personne non trouvé");
        }
    }

    public function depublier($idPersonne)
    {
        try {
            $personne = Personne::findOrFail($idPersonne);
            $personne->publie = false;
            $personne->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundAnnuaireException("Personne non trouvé");
        }
    }

    public function createAdmin(array $newAdminData)
    {
        try {
            $newAdmin = new Admin();
            $newAdmin->username = $newAdminData['username'];
            $newAdmin->password = $newAdminData['password'];
            $newAdmin->is_super_admin = 0;
            $newAdmin->save();
        } catch (QueryException $e) {
            throw new NotFoundAnnuaireException("Erreur");
        }
    }
}