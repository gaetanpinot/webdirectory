<?php

namespace web\api\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Telephone extends Model
{
    //telephone_personne(pk fk int id_personne, varchar num)
    protected $table = 'telephone_personne';
    protected $primaryKey = 'id_personne';
    public $timestamps = false;
    public $incrementing = true;

}