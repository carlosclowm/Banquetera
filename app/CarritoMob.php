<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoMob extends Model
{
    protected $table='carrito_mobiliario';
    protected $primaryKey='id_carrito';
    public $timestamps=false;

    protected $fillable =[
    	'id_carrito',
    	'id_mob',
    	'tipo',
    	'nombre',
    	'cantidad',
    	'token',
    	'seccion'
    ];
}
