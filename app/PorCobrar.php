<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PorCobrar extends Model
{
  protected $table='por_cobrar';
  protected $primaryKey='id_ventas';
  public $timestamps=false;

  protected $fillable =[
    'id_ventas',
    'fecha',
    'total',
    'abonado'
  ];
}
