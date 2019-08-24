<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoCos extends Model
{
    protected $table='carrito_cocina';
    protected $primaryKey='id_carrito';
    public $timestamps=false;

    protected $fillable =[
    	'id_carrito',
    	'id_cocina',
    	'tipo',
    	'nombre',
    	'cantidad',
    	'token',
    	'seccion'
    ];
}
