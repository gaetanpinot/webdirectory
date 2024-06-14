<?php

namespace web\admin\core\services\entries;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use web\admin\core\domain\entities\Fonction;
use web\admin\core\domain\entities\Personne;
use web\admin\core\domain\entities\Service;

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

    public function getPersonnesWithServices(){
        try{
            $personnes=Personne::with('service')->get();
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