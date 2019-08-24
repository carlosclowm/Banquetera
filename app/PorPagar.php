<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PorPagar extends Model
{
  protected $table='por_pagar';
  protected $primaryKey='id_compras';
  public $timestamps=false;

  protected $fillable =[
    'id_compras',
    'fecha',
    'total',
    'nombre_proveedor',
    'id_proveedor',
    'estado'
  ];
}
