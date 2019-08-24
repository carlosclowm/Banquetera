<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobiliario extends Model
{
    protected $table='mobiliario';
    protected $primaryKey='id_mob';
    public $timestamps=false;

    protected $fillable =[
    	'id_mob',
    	'tipo',
    	'nombre',
    	'existencia'
    ];
}
