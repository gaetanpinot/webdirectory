<?php

namespace web\api\core\domain\entities;

use Illuminate\Database\Eloquent\Model;
class Fonction extends Model
{
    protected $table = 'fonction';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
}