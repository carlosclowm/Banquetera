<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraCos extends Model
{
  protected $table='compra_cos';
  protected $primaryKey='id_compra';
  public $timestamps=false;

  protected $fillable =[
    'id_compra',
    'id_cos',
    'tipo',
    'nombre',
    'cantidad',
    'fecha'
  ];
}
