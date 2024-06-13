<?php
namespace web\api\core\domain\entities ;
class Fonction extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'fonction';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
//fonction(pk int id,varchar libelle)

    public function personne(){
        return $this->belongsToMany('web\api\core\domain\entities\Personne','fonction_personne','id_fonction','id_personne');
    }
}