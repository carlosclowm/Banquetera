<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaMob extends Model
{
  protected $table='venta_mob';
  protected $primaryKey='id_venta';
  public $timestamps=false;

  protected $fillable =[
    'id_venta',
    'id_mob',
    'tipo',
    'nombre',
    'cantidad',
    'fecha'
  ];
}
