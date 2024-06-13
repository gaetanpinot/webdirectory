<?php

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    protected $table = 'personne';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
}