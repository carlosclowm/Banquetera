<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\MotivoGasto;
use App\Gasto;
use DB;

class GastosController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function Gastos(){
    $Gastos = DB::table('gastos')->paginate(7);
    $Motivos = DB::table('motivo_gasto')->get();
    return view('Gastos.Lista', ['Gastos'=>$Gastos, 'Motivos'=>$Motivos]);
  }

  public function MotivoGastos(){
    $Motivo = DB::table('motivo_gasto')->paginate(7);
    return view('Gastos.AgregarMotivo', ['Motivo'=>$Motivo]);
  }

  public function NuevoMotivo(Request $res){
    $Motivo = new MotivoGasto;
    $Motivo->id_gasto = $res->get('clave');
    $Motivo->nombre = $res->get('nombre');
    $Motivo->descripcion = $res->get('descripcion');
    $Motivo->save();
    return Redirect::back();
  }

  public function NuevoGasto(Request $res){
    $now = new \DateTime;
    $Fecha = $now->format('Y-m-d H:i:s');

    $Motivo = DB::table('motivo_gasto')->where('id_gasto','=',$res->get('clave'))->first();

    $Gasto = new Gasto;
    $Gasto->fecha = $Fecha;
    $Gasto->monto = $res->get('monto');
    $Gasto->motivo = $Motivo->id_gasto;
    $Gasto->motivo_nombre = $Motivo->nombre;
    $Gasto->save();

    return Redirect::back();
  }
}
