<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoGasto extends Model
{
  protected $table='motivo_gasto';
  protected $primaryKey='id_gasto';
  public $timestamps=false;

  protected $fillable =[
    'id_gasto',
    'nombre',
    'descripcion'
  ];
}
