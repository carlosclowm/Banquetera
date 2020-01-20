<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Ventas;
use App\Compras;
use App\VentaMob;
use App\VentaCos;
use App\VentaBot;
use App\Mobiliario;
use App\Cocina;
use App\Botellas;
use App\PorCobrar;
use App\CompraMob;
use App\CompraCos;
use App\CompraBot;
use DB;

class ReportesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function Compras(){
    $Compras = DB::table('compras')->orderBy('id_compras', 'desc')->paginate(15);
    return view('Inventario.Reportes.Compras', ['Compra'=>$Compras]);
  }

  public function Ventas(){
    $Ventas = DB::table('ventas')->orderBy('id_ventas', 'desc')->paginate(15);
    return view('Inventario.Reportes.Ventas', ['Venta'=>$Ventas]);
  }

  public function Resumen(){
    $Clientes = DB::table('clientes')->get();
    $Proveedores = DB::table('proveedores')->get();
    $Mobiliario = DB::table('mobiliario')->get();
    $Cocina = DB::table('cocina')->get();
    $Botellas = DB::table('botellas')->get();
    return view('Inventario.Reportes.Resumen', ['Clientes'=>$Clientes, 'Proveedores'=>$Proveedores, 'Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botellas'=>$Botellas]);
  }

  public function ResumenFecha(Request $res){
    $Ventas = DB::table('ventas')->whereBetween('fecha', [$res->del, $res->hasta])->get();
    $Resumen_Ventas = 0;
    foreach ($Ventas as $vn) {
      $Resumen_Ventas = $Resumen_Ventas + $vn->total;
    }
    return view('Inventario.Reportes.Resumen', ['Ventas'=>$Ventas, 'Resumen'=>$Resumen_Ventas]);
  }

  public function ResumenCliente($id){
    $Cliente = DB::table('clientes')->where('id_cliente','=',$id)->first();
    $Ventas = DB::table('ventas')->where('id_cliente','=', $id)->get();
    $Resumen_Cliente = 0;
    foreach ($Ventas as $vn) {
      $Resumen_Cliente = $Resumen_Cliente + $vn->total;
    }
    return view('Inventario.Reportes.Resumen', ['Ventas_Clientes'=>$Resumen_Cliente, 'Clientes_Resumen'=>$Ventas]);
  }

  public function ResumenProveedor($id){
    $Proveedor = DB::table('proveedores')->where('id_proveedor', '=', $id)->first();
    $Compras = DB::table('compras')->where('id_proveedor','=',$id)->get();
    $Resumen_Proveedor = 0;
    foreach ($Compras as $com) {
      $Resumen_Proveedor = $Resumen_Proveedor + $com->total;
    }
    return view('Inventario.Reportes.Resumen', ['Resumen_Proveedor'=>$Resumen_Proveedor, 'Compras_Prov'=>$Compras]);
  }

  public function ResumenMobiliario($id){
    $Mobiliario = DB::table('mobiliario')->where('id_mob','=',$id)->first();
    $Ventas = DB::table('venta_mob')->where('id_mob','=',$id)->get();
    $Compras = DB::table('compra_mob')->where('id_mob','=',$id)->get();
    $Total_Compras = 0;
    foreach ($Compras as $com) {
      $Total_Compras = $Total_Compras + ($com->costo*$com->cantidad);
    }
    $Total_Ventas = 0;
    foreach ($Ventas as $vn) {
      $Total_Ventas = $Total_Ventas + ($vn->costo*$vn->cantidad);
    }
    return view('Inventario.Reportes.Resumen', ['Producto_Mobiliario'=>$Mobiliario, 'Total_Compras'=>$Total_Compras, 'Total_Ventas'=>$Total_Ventas]);
  }

  public function ResumenCocina($id){
    $Cocina = DB::table('cocina')->where('id_cocina','=',$id)->first();
    $Ventas = DB::table('venta_cos')->where('id_cos','=',$id)->get();
    $Compras = DB::table('compra_cos')->where('id_cos','=',$id)->get();
    $Total_Compras = 0;
    foreach ($Compras as $com) {
      $Total_Compras = $Total_Compras + ($com->costo*$com->cantidad);
    }
    $Total_Ventas = 0;
    foreach ($Ventas as $vn) {
      $Total_Ventas = $Total_Ventas + ($vn->costo*$vn->cantidad);
    }
    return view('Inventario.Reportes.Resumen', ['Producto_Cocina'=>$Cocina, 'Total_Compras'=>$Total_Compras, 'Total_Ventas'=>$Total_Ventas]);
  }

  public function ResumenBotellas($id){
    $Botella = DB::table('botellas')->where('id_botella','=',$id)->first();
    $Ventas = DB::table('venta_bot')->where('id_botella','=',$id)->get();
    $Compras = DB::table('compra_bot')->where('id_botella','=',$id)->get();
    $Total_Compras = 0;
    foreach ($Compras as $com) {
      $Total_Compras = $Total_Compras + ($com->costo*$com->cantidad);
    }
    $Total_Ventas = 0;
    foreach ($Ventas as $vn) {
      $Total_Ventas = $Total_Ventas + ($vn->costo*$vn->cantidad);
    }
    return view('Inventario.Reportes.Resumen', ['Producto_Botella'=>$Botella, 'Total_Compras'=>$Total_Compras, 'Total_Ventas'=>$Total_Ventas]);
  }

  public function EliminarVenta($id){
    $Venta = Ventas::findOrFail($id);
    $VentaMob = DB::table('venta_mob')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Vendido')->get();
    $VentaCos = DB::table('venta_cos')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Vendido')->get();
    $VentaBot = DB::table('venta_bot')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Vendido')->get();
    foreach ($VentaMob as $mob) {
      $RM = VentaMob::findOrFail($mob->id_venta);
      $ADD = Mobiliario::findOrFail($mob->id_mob);
      $ADD->existencia = $ADD->existencia + $mob->cantidad;
      $ADD->update();
      $RM->delete();
    }
    foreach ($VentaCos as $cos) {
      $RM = VentaCos::findOrFail($cos->id_venta);
      $ADD = Cocina::findOrFail($cos->id_cos);
      $ADD->existencia = $ADD->existencia + $cos->cantidad;
      $ADD->update();
      $RM->delete();
    }
    foreach ($VentaBot as $bot) {
      $RM = VentaBot::findOrFail($bot->id_venta);
      $ADD = Botellas::findOrFail($bot->id_botella);
      $ADD->existencia = $ADD->existencia + $bot->cantidad;
      $ADD->update();
      $RM->delete();
    }
    $Venta->delete();
    return Redirect::back();
  }

  public function MoverVentaPorCobrar($id){
    $Venta = Ventas::findOrFail($id);
    $VentaMob = DB::table('venta_mob')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();
    $VentaCos = DB::table('venta_cos')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();
    $VentaBot = DB::table('venta_bot')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();

    $PorCobrar = new PorCobrar;
    $PorCobrar->id_cliente = $Venta->id_cliente;
    $PorCobrar->nombre_cliente = $Venta->nombre_cliente;
    $PorCobrar->fecha = $Venta->fecha;
    $PorCobrar->total = $Venta->total;
    $PorCobrar->abonado = 0;
    $PorCobrar->save();

    foreach ($VentaMob as $mob) {
      $VM = VentaMob::findOrFail($mob->id_venta);
      $VM->estado = "PorCobrar";
      $VM->id_factura = $PorCobrar->id_ventas;
      $VM->update();
    }
    foreach ($VentaCos as $cos) {
      $VC = VentaCos::findOrFail($cos->id_venta);
      $VC->estado = "PorCobrar";
      $VC->id_factura = $PorCobrar->id_ventas;
      $VC->update();
    }
    foreach ($VentaBot as $bot) {
      $VB = VentaBot::findOrFail($bot->id_venta);
      $VB->estado = "PorCobrar";
      $VB->id_factura = $PorCobrar->id_ventas;
      $VB->update();
    }
    $Venta->delete();

    return view('Factura.VentaPorCobrar', ['Factura'=>$PorCobrar, 'Debe'=>$PorCobrar->abonado]);
  }

  public function MoverPorCobrarVenta($id){
    $Venta = PorCobrar::findOrFail($id);
    $VentaMob = DB::table('venta_mob')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();
    $VentaCos = DB::table('venta_cos')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();
    $VentaBot = DB::table('venta_bot')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();

    $Ventas = new Ventas;
    $Ventas->id_cliente = $Venta->id_cliente;
    $Ventas->nombre_cliente = $Venta->nombre_cliente;
    $Ventas->fecha = $Venta->fecha;
    $Ventas->total = $Venta->total;
    $Ventas->save();

    foreach ($VentaMob as $mob) {
      $VM = VentaMob::findOrFail($mob->id_venta);
      $VM->estado = "Vendido";
      $VM->id_factura = $Ventas->id_ventas;
      $VM->update();
    }
    foreach ($VentaCos as $cos) {
      $VC = VentaCos::findOrFail($cos->id_venta);
      $VC->estado = "Vendido";
      $VC->id_factura = $Ventas->id_ventas;
      $VC->update();
    }
    foreach ($VentaBot as $bot) {
      $VB = VentaBot::findOrFail($bot->id_venta);
      $VB->estado = "Vendido";
      $VB->id_factura = $Ventas->id_ventas;
      $VB->update();
    }
    $Venta->delete();

    return view('Factura.Venta', ['Factura'=>$Ventas]);
  }

  public function EliminarCompra($id){
    $Venta = Compras::findOrFail($id);
    $VentaMob = DB::table('compra_mob')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Comprado')->get();
    $VentaCos = DB::table('compra_cos')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Comprado')->get();
    $VentaBot = DB::table('compra_bot')->where('id_factura','=',$Venta->id_ventas)->where('estado','=','Comprado')->get();
    foreach ($VentaMob as $mob) {
      $RM = CompraMob::findOrFail($mob->id_venta);
      $ADD = Mobiliario::findOrFail($mob->id_mob);
      $ADD->existencia = $ADD->existencia - $mob->cantidad;
      $ADD->update();
      $RM->delete();
    }
    foreach ($VentaCos as $cos) {
      $RM = CompraCos::findOrFail($cos->id_venta);
      $ADD = Cocina::findOrFail($cos->id_cos);
      $ADD->existencia = $ADD->existencia - $cos->cantidad;
      $ADD->update();
      $RM->delete();
    }
    foreach ($VentaBot as $bot) {
      $RM = CompraBot::findOrFail($bot->id_venta);
      $ADD = Botellas::findOrFail($bot->id_botella);
      $ADD->existencia = $ADD->existencia - $bot->cantidad;
      $ADD->update();
      $RM->delete();
    }
    $Venta->delete();
    return Redirect::back();
  }
}
