<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarritoBot extends Model
{
    protected $table='carrito_botellas';
    protected $primaryKey='id_carrito';
    public $timestamps=false;

    protected $fillable =[
    	'id_carrito',
    	'id_botella',
    	'categoria',
    	'nombre',
    	'capacidad',
    	'cantidad',
    	'token',
    	'seccion'
    ];
}
