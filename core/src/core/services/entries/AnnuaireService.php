<?php

namespace web\api\core\services\entries;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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

    public function getPersonneById(int $id): array
    {
        try {

            $personne = Personne::where('id','=',$id)->with('service')->get();

            if (!$personne) throw new ModelNotFoundException();

            return $personne->toArray();

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

    public function getServices()
    {
        try{
            $services = Service::get();

            return($services->toArray());

        }catch (QueryException $e ){


        }
    }

    public function getFonctions()
    {
        try{
            $fonction = Fonction::get();

            return $fonction->toArray();
        }catch(QueryException $e){

        }
    }

    public function getPersonnesWithServices($order=""){
        try{
            $personnes=Personne::with('service');
            switch($order){
                case 'nom-desc':
                    $personnes->orderByDesc('nom');
                    break;
                case 'nom-asc':
                    $personnes->orderBy('nom');
                    break;
                default:
                    break;

            }
            $personnes=$personnes->get();
            return $personnes->toArray();
        }catch (QueryException $e){

        }
    }


    public function getPersonnesByServices(mixed $id)
    {
        try{
//            $personnes=Personne::whereHas('service',function($query) use($id){
//                $query->where('id','=',$id);
//            })->get();
            $personnes=Service::where('id','=',$id)->with('personnes')->get();
            return $personnes->toArray();
        }catch (QueryException $e){

        }catch (ModelNotFoundException $e){

        }
    }

    public function getPersonnesContainName(string $name)
    {
        try{
            $personnes=Personne::where('nom','like','%'.$name.'%')->get();
            return $personnes->toArray();
        }catch (QueryException $e){

        }catch (ModelNotFoundException $e){

        }
    }
}