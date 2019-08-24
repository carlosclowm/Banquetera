<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
  protected $table='gastos';
  protected $primaryKey='id_gasto';
  public $timestamps=false;

  protected $fillable =[
    'id_gasto',
    'motivo',
    'motivo_nombre',
    'monto',
    'fecha'
  ];
}
