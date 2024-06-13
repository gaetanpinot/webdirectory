<?php
namespace web\api\core\domain\entities ;

use Illuminate\Database\Eloquent\Model;
class Fonction extends Model
{
    protected $table = 'fonction';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
//fonction(pk int id,varchar libelle)

    public function personnes(){
        return $this->belongsToMany('web\api\core\domain\entities\Personne','fonction_personne','id_fonction','id_personne');
    }
}