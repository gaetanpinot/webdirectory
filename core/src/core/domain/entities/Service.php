<?php
namespace web\api\core\domain\entities ;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
//fonction(pk int id,varchar libelle)
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
//personne_service(pk fk int id_personne, pk fk int id_service)

    public function personnes(){
        return $this->belongsToMany('web\api\core\domain\entities\Personne','personne_service','id_service','id_personne');
    }
}
