<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Botellas extends Model
{
    protected $table='botellas';
    protected $primaryKey='id_botella';
    public $timestamps=false;

    protected $fillable =[
    	'id_botella',
    	'categoria',
    	'nombre',
    	'capacidad',
    	'existencia',
    	'costo'
    ];
}
