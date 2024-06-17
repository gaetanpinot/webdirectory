<?php

namespace web\admin\app\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpInternalServerErrorException;
use Slim\Views\Twig;
use web\admin\app\actions\AbstractAction;
use web\admin\core\services\entries\AnnuaireService;
use web\admin\core\services\NotFoundAnnuaireException;

class GetAllPersonne extends AbstractAction
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $annuaire=new AnnuaireService();
        if(isset($_GET['filter'])){
            $filter=$_GET['filter'];
            $filtre=$annuaire->getServiceById($filter);
        }else{
            $filter='';
            $filtre='';
        }
        $personnes=$annuaire->getPersonnesWithServices('nom-asc',$filter);
        $services=$annuaire->getServices();
        $view=Twig::fromRequest($request);
//        var_dump($personnes);
        return $view->render($response,'GetAllPersonne.twig',['personnes'=>$personnes,'services'=>$services,'filtre'=>$filtre]);
    }

}