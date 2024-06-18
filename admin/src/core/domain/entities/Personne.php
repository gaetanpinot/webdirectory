<?php

namespace web\admin\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
//personne(pk int id, varchar nom, varchar prenom, varchar num_bureau, varchar mail, varchar url_img)

    protected $table = 'personne';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    //fonction_personne(pk fk int id_personne,pk fk int id_fonction)
    public function fonction()
    {
        return $this->belongsToMany('web\api\core\domain\entities\Fonction', 'fonction_personne', 'id_personne', 'id_fonction');
    }

    //telephone_personne(pk fk int id_personne, varchar num)
    public function telephone()
    {
        return $this->hasMany('web\api\core\domain\entities\Telephone', 'id_personne');
    }

    //personne_service(pk fk int id_personne, pk fk int id_service)

    public function service()
    {
        return $this->belongsToMany(Service::class, 'personne_service', 'id_personne', 'id_service');
    }
}