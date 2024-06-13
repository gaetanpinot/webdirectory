<?php

class Service extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'service';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;
}