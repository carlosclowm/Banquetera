<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
  protected $table='ventas';
  protected $primaryKey='id_ventas';
  public $timestamps=false;

  protected $fillable =[
    'id_ventas',
    'fecha',
    'total'
  ];
}
