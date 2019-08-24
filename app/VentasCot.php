<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasCot extends Model
{
  protected $table='ventas_cot';
  protected $primaryKey='id_ventas';
  public $timestamps=false;

  protected $fillable =[
    'id_ventas',
    'fecha',
    'total'
  ];
}
