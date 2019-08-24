<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
  protected $table='compras';
  protected $primaryKey='id_compras';
  public $timestamps=false;

  protected $fillable =[
    'id_compras',
    'fecha',
    'total'
  ];
}
