<?php

namespace web\admin\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    use HasUuids;

    protected $table = 'admin_user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;

}