<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevoMob extends Model
{
  protected $table='dev_mob';
  protected $primaryKey='id_compra';
  public $timestamps=false;

  protected $fillable =[
    'id_compra',
    'id_mob',
    'tipo',
    'nombre',
    'cantidad',
    'fecha'
  ];
}
