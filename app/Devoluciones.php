<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devoluciones extends Model
{
  protected $table='devoluciones';
  protected $primaryKey='id_compras';
  public $timestamps=false;

  protected $fillable =[
    'id_compras',
    'fecha',
    'total'
  ];
}
