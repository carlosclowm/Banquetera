<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompraBot extends Model
{
  protected $table='compra_bot';
  protected $primaryKey='id_compra';
  public $timestamps=false;

  protected $fillable =[
    'id_compra',
    'id_botella',
    'categoria',
    'nombre',
    'capacidad',
    'cantidad',
    'fecha'
  ];
}
