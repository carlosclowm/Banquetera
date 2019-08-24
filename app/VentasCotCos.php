<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasCotCos extends Model
{
  protected $table='venta_cos_cot';
  protected $primaryKey='id_venta';
  public $timestamps=false;

  protected $fillable =[
    'id_venta',
    'id_cos',
    'tipo',
    'nombre',
    'cantidad',
    'fecha'
  ];
}
