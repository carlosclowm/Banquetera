<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasDev extends Model
{
  protected $table='venta_dev';
  protected $primaryKey='id_ventas';
  public $timestamps=false;

  protected $fillable =[
    'id_ventas',
    'fecha',
    'total'
  ];
}
