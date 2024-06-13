<?php

class Personne extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'personne';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
}