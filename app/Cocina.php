<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cocina extends Model
{
    protected $table='cocina';
    protected $primaryKey='id_cocina';
    public $timestamps=false;

    protected $fillable =[
    	'id_cocina',
    	'tipo',
    	'nombre',
    	'existencia'
    ];
}
