<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PorCobrar;
use App\Ventas;
use App\PorPagar;
use DB;

class CuentasController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function PorCobrar(){
    $PorCobrar = DB::table('por_cobrar')->orderBy('id_ventas', 'desc')->paginate(7);
    return view('Inventario.PorCobrar.Listado', ['PorCobrar'=>$PorCobrar]);
  }
  public function PorCobrarLiquidar($id){
    $PorCobrar = PorCobrar::findOrFail($id);
    $now = new \DateTime;
    $Fecha = $now->format('Y-m-d H:i:s');
    $Ventas = new Ventas;
    $Ventas->id_cliente = $PorCobrar->id_cliente;
    $Ventas->fecha = $Fecha;
    $Ventas->total = $PorCobrar->total;
    $Ventas->save();
    $PorCobrar->delete();
    return view('Factura.Venta', ['Factura'=>$Ventas]);
  }
  public function Abonar(Request $res){
    $PorCobrar = PorCobrar::findOrFail($res->get('id'));
    $PorCobrar->abonado = $PorCobrar->abonado + $res->get('abono');
    $PorCobrar->update();
    $Deuda =  $PorCobrar->total - $PorCobrar->abonado;
    return view('Factura.VentaPorCobrar', ['Factura'=>$PorCobrar, 'Debe'=>$Deuda]);
  }

  public function PorPagar(){
    $PorPagar = DB::table('por_pagar')->orderBy('id_compras', 'desc')->paginate(7);
    return view('Inventario.PorPagar.Listado', ['PorPagar'=>$PorPagar]);
  }
  public function AbonarPorPagar(Request $res){
    $PorPagar = PorPagar::findOrFail($res->get('id'));
    $PorPagar->abonado = $PorPagar->abonado + $res->get('abono');
    $PorPagar->update();
    $Deuda =  $PorPagar->total - $PorPagar->abonado;
    return view('Factura.CompraPorPagar', ['Factura'=>$PorPagar, 'Deuda'=>$Deuda]);
  }
}
