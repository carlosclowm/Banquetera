<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaBot extends Model
{
  protected $table='venta_bot';
  protected $primaryKey='id_venta';
  public $timestamps=false;

  protected $fillable =[
    'id_venta',
    'id_botella',
    'categoria',
    'nombre',
    'capacidad',
    'cantidad',
    'fecha'
  ];
}
