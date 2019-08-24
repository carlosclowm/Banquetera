<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasDevBot extends Model
{
  protected $table='venta_bot_dev';
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
