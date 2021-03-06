<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
  protected $table='proveedores';
  protected $primaryKey='id_proveedor';
  public $timestamps=false;

  protected $fillable =[
    'id_proveedor',
    'nombre',
    'empresa',
    'rfc',
    'telefono'
  ];
}
