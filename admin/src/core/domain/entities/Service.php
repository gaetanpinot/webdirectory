<?php

namespace web\admin\core\domain\entities ;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
//personne_service(pk fk int id_personne, pk fk int id_service)

    public function personnes(){
        return $this->belongsToMany('web\admin\core\domain\entities\Personne','personne_service','id_service','id_personne');
    }
}
