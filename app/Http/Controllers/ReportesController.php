<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
