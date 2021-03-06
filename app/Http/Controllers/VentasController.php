<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\CarritoMob;
use App\Mobiliario;
use App\Cocina;
use App\CarritoCos;
use App\Botellas;
use App\CarritoBot;
use App\VentaMob;
use App\VentaCos;
use App\VentaBot;
use App\Ventas;
use App\VentasDevMob;
use App\VentasDevCos;
use App\VentasDevBot;
use App\VentasDev;
use App\VentasCotMob;
use App\VentasCotCos;
use App\VentasCotBot;
use App\VentasCot;
use App\PorCobrar;
use DB;
use View;

class VentasController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function Vender(){
      $Cliente = DB::table('clientes')->get();
      $Mobiliario = DB::table('mobiliario')->get();
    	$Cocina = DB::table('cocina')->get();
    	$Botella = DB::table('botellas')->get();
      $CarritoMob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoCos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoBot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Total = 0;
      foreach($CarritoMob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($CarritoCos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($CarritoBot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
      return view('Inventario.Ventas.Vender', ['Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botella'=>$Botella,
      'Carrito_Mob'=>$CarritoMob, 'Carrito_Cos'=>$CarritoCos, 'Carrito_Bot'=>$CarritoBot, 'Total'=>$Total, 'Cliente'=>$Cliente]);
    }

    public function GetBotellas(){
      return DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
    }
    public function GetCocina(){
      return DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
    }
    public function GetMob(){
      return DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
    }

    public function AgregarMob(Request $res){
      $Mobiliario = Mobiliario::findOrFail($res->get('id'));
    	$Carrito = new CarritoMob;
    	$Carrito->id_mob = $Mobiliario->id_mob;
    	$Carrito->tipo = $Mobiliario->tipo;
    	$Carrito->nombre = $Mobiliario->nombre;
    	$Carrito->cantidad = $res->get('cantidad');
      $Carrito->costo = $res->get('costo');
    	$Carrito->token = csrf_token();
    	$Carrito->seccion = 'Ventas';
    	$Carrito->save();
    	return Redirect::back();
    }
    public function AgregarCos(Request $res){
    	$Cocina = Cocina::findOrFail($res->get('id'));
    	$Carrito = new CarritoCos;
    	$Carrito->id_cocina = $Cocina->id_cocina;
    	$Carrito->tipo = $Cocina->tipo;
    	$Carrito->nombre = $Cocina->nombre;
    	$Carrito->cantidad = $res->get('cantidad');
      $Carrito->costo = $res->get('costo');
    	$Carrito->token = csrf_token();
    	$Carrito->seccion = 'Ventas';
    	$Carrito->save();
    	return Redirect::back();
    }
    public function AgregarBot(Request $res){
    	$Botellas = Botellas::findOrFail($res->get('id'));
    	$Carrito = new CarritoBot;
    	$Carrito->id_botella = $Botellas->id_botella;
    	$Carrito->categoria = $Botellas->categoria;
    	$Carrito->nombre = $Botellas->nombre;
    	$Carrito->capacidad = $Botellas->capacidad;
    	$Carrito->cantidad = $res->get('cantidad');
      $Carrito->costo = $res->get('costo');
    	$Carrito->token = csrf_token();
    	$Carrito->seccion = 'Ventas';
    	$Carrito->save();
    	return Redirect::back();
    }
    public function EditarCostoMob(Request $res){
      $Edit = CarritoMob::findOrFail($res->get('id'));
      $Edit->costo = $res->get('costo');
      $Edit->update();
      return Redirect::back();
    }
    public function EditarCostoCos(Request $res){
      $Edit = CarritoCos::findOrFail($res->get('id'));
      $Edit->costo = $res->get('costo');
      $Edit->update();
      return Redirect::back();
    }
    public function EditarCostoBot(Request $res){
      $Edit = CarritoBot::findOrFail($res->get('id'));
      $Edit->costo = $res->get('costo');
      $Edit->update();
      return Redirect::back();
    }
    public function EliminarMob($id){
    	$Eliminar = CarritoMob::findOrFail($id);
    	$Eliminar->delete();
    	return Redirect::back();
    }
    public function EliminarCos($id){
    	$Eliminar = CarritoCos::findOrFail($id);
    	$Eliminar->delete();
    	return Redirect::back();
    }
    public function EliminarBot($id){
    	$Eliminar = CarritoBot::findOrFail($id);
    	$Eliminar->delete();
    	return Redirect::back();
    }
    public function Realizar($ClienteID){
      $ID_MAX = DB::table('ventas')->max('id_ventas') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new VentaMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "Vendido";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $update = Mobiliario::findOrFail($mob->id_mob);
          $update->existencia = $update->existencia - $mob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new VentaCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "Vendido";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $update = Cocina::findOrFail($cos->id_cocina);
          $update->existencia = $update->existencia - $cos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new VentaBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "Vendido";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $update = Botellas::findOrFail($bot->id_botella);
          $update->existencia = $update->existencia - $bot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
        //endtotal
        $Compra = new Ventas;
        $Compra->id_cliente = $ClienteID;
        $Cliente = DB::table('clientes')->where('id_cliente','=',$ClienteID)->first();
        $Compra->nombre_cliente = $Cliente->nombre;
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->save();
        return view('Factura.Venta', ['Factura'=>$Compra]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }
    }
    public function OrdenVenta($Factura){
      $Compra = Ventas::findOrFail($Factura);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.VentaOrden', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }

    public function Devolver(){
      $Cliente = DB::table('clientes')->get();
      $Mobiliario = DB::table('mobiliario')->get();
    	$Cocina = DB::table('cocina')->get();
    	$Botella = DB::table('botellas')->get();
      $CarritoMob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoCos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoBot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Total = 0;
      foreach($CarritoMob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($CarritoCos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($CarritoBot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
      return view('Inventario.Ventas.Devolver', ['Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botella'=>$Botella,
      'Carrito_Mob'=>$CarritoMob, 'Carrito_Cos'=>$CarritoCos, 'Carrito_Bot'=>$CarritoBot, 'Total'=>$Total, 'Cliente'=>$Cliente]);
    }

    public function DevolverVenta(Request $res){
      $ID_MAX = DB::table('venta_dev')->max('id_ventas') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new VentasDevMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "Devuelto";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $update = Mobiliario::findOrFail($mob->id_mob);
          $update->existencia = $update->existencia + $mob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new VentasDevCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "Devuelto";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $update = Cocina::findOrFail($cos->id_cocina);
          $update->existencia = $update->existencia + $cos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new VentasDevBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "Devuelto";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $update = Botellas::findOrFail($bot->id_botella);
          $update->existencia = $update->existencia + $bot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
        //endtotal
        $Compra = new VentasDev;
        $Compra->id_cliente = $res->get('id');
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->razon = $res->get('razon');
        $Compra->save();
        return view('Factura.VentasDev', ['Factura'=>$Compra]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }
    }

    public function OrdenVentaDevolver($Factura){
      $Compra = VentasDev::findOrFail($Factura);
      $CompraMob = DB::table('venta_mob_dev')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      $CompraCos = DB::table('venta_cos_dev')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      $CompraBot = DB::table('venta_bot_dev')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.VentaOrdenDev', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }

    public function Cotizar(){
      $Cliente = DB::table('clientes')->get();
      $Mobiliario = DB::table('mobiliario')->get();
    	$Cocina = DB::table('cocina')->get();
    	$Botella = DB::table('botellas')->get();
      $CarritoMob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoCos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $CarritoBot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Total = 0;
      foreach($CarritoMob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($CarritoCos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($CarritoBot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
      return view('Inventario.Ventas.Cotizar', ['Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botella'=>$Botella,
      'Carrito_Mob'=>$CarritoMob, 'Carrito_Cos'=>$CarritoCos, 'Carrito_Bot'=>$CarritoBot, 'Total'=>$Total, 'Cliente'=>$Cliente]);
    }

    public function CotizarVenta($ClienteID){
      $ID_MAX = DB::table('ventas_cot')->max('id_ventas') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new VentasCotMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "Cotizado";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new VentasCotCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "Cotizado";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new VentasCotBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "Cotizado";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
        //endtotal
        $Compra = new VentasCot;
        $Compra->id_cliente = $ClienteID;
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->save();
        return view('Factura.VentaCotizado', ['Factura'=>$Compra]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }
    }

    public function OrdenVentaCotizar($Factura){
      $Compra = VentasCot::findOrFail($Factura);
      $CompraMob = DB::table('venta_mob_cot')->where('id_factura','=',$Factura)->where('estado','=','Cotizado')->get();
      $CompraCos = DB::table('venta_cos_cot')->where('id_factura','=',$Factura)->where('estado','=','Cotizado')->get();
      $CompraBot = DB::table('venta_bot_cot')->where('id_factura','=',$Factura)->where('estado','=','Cotizado')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.VentaOrdenCot', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }

    public function PorCobrar(Request $res){
      $ID_MAX = DB::table('por_cobrar')->max('id_ventas') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Ventas')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Ventas')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new VentaMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "PorCobrar";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $update = Mobiliario::findOrFail($mob->id_mob);
          $update->existencia = $update->existencia - $mob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new VentaCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "PorCobrar";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $update = Cocina::findOrFail($cos->id_cocina);
          $update->existencia = $update->existencia - $cos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new VentaBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "PorCobrar";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $update = Botellas::findOrFail($bot->id_botella);
          $update->existencia = $update->existencia - $bot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + ($Mob->costo*$Mob->cantidad);
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + ($Cos->costo*$Cos->cantidad);
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + ($Bot->costo*$Bot->cantidad);
        }
        //endtotal
        $Compra = new PorCobrar;
        $Compra->id_cliente = $res->get('id');
        $Cliente = DB::table('clientes')->where('id_cliente','=',$res->get('id'))->first();
        $Compra->nombre_cliente = $Cliente->nombre;
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->abonado = $res->get('abono');
        $Compra->save();
        $Deuda = $Total - $res->get('abono');
        return view('Factura.VentaPorCobrar', ['Factura'=>$Compra, 'Debe'=>$Deuda]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }
    }

    public function OrdenCobrar($Factura){
      $Compra = PorCobrar::findOrFail($Factura);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.VentaOrdenCobrar', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }

    public function GetTotalVendido($id){
       $Factura = Ventas::findOrFail($id);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      return $Total;
    }

    public function EditarOrdenVenta($id){
      $Compra = Ventas::findOrFail($id);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$id)->where('estado','=','Vendido')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.Editor.VentaOrden', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }


    //this
    public function EditarOrdenVentaGuardar(Request $res){
      $Mob = VentaMob::findOrFail($res->get("id"));
      $InvMob = Mobiliario::findOrFail($Mob->id_mob);
      if($Mob->cantidad > $res->get("cantidad")){
        $InvMob->existencia = $InvMob->existencia + ($Mob->cantidad-$res->get("cantidad"));
      }else{
        $InvMob->existencia = $InvMob->existencia - ($Mob->cantidad-$res->get("cantidad"));
      }
      $InvMob->update();
      $Mob->cantidad = $res->get("cantidad");
      $Mob->costo = $res->get("costo");
      $Mob->update();
      $Factura = Ventas::findOrFail($res->get("factura"))->id_ventas;
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura)->where('estado','=','Vendido')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $SaveFactura = Ventas::findOrFail($Factura);
      $SaveFactura->total = $Total;
      $SaveFactura->update();
    }
    public function EditarOrdenVentaEliminar(Request $res){
      $CompraMob = VentaMob::findOrFail($res->get("id"));
      $InvMob = Mobiliario::findOrFail($CompraMob->id_mob);
      if($CompraMob->cantidad > $res->get("cantidad")){
        $InvMob->existencia = $InvMob->existencia + ($CompraMob->cantidad-$res->get("cantidad"));
      }else{
        $InvMob->existencia = $InvMob->existencia - ($CompraMob->cantidad-$res->get("cantidad"));
      }
      $InvMob->update();
      $Factura = Ventas::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($CompraMob->cantidad*$CompraMob->costo);
      $CompraMob->delete();
      $Factura->update();
      
    }

    public function EditarOrdenCos(Request $res){
      $Cos = VentaCos::findOrFail($res->get("id"));
      $InvCos = Cocina::findOrFail($Cos->id_cos);
      if($Cos->cantidad > $res->get("cantidad")){
        $InvCos->existencia = $InvCos->existencia + ($Cos->cantidad-$res->get("cantidad"));
      }else{
        $InvCos->existencia = $InvCos->existencia - ($Cos->cantidad-$res->get("cantidad"));
      }
      $InvCos->update();
      $Cos->cantidad = $res->get("cantidad");
      $Cos->costo = $res->get("costo");
      $Cos->update();
      $Factura = Ventas::findOrFail($res->get("factura"));
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $Factura->total = $Total;
      $Factura->update();
    }

    public function EditarOrdenCosDel(Request $res){
      $Cos = VentaCos::findOrFail($res->get("id"));
      $InvCos = Cocina::findOrFail($Cos->id_cos);
      if($Cos->cantidad > $res->get("cantidad")){
        $InvCos->existencia = $InvCos->existencia + ($Cos->cantidad-$res->get("cantidad"));
      }else{
        $InvCos->existencia = $InvCos->existencia - ($Cos->cantidad-$res->get("cantidad"));
      }
      $InvCos->update();
      $Factura = Ventas::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($Cos->cantidad*$Cos->costo);
      $Cos->delete();
      $Factura->update();
    }

    public function EditarOrdenBot(Request $res){
      $Bot = VentaBot::findOrFail($res->get("id"));
      $InvBot = Botellas::findOrFail($Bot->id_botella);
      if($Bot->cantidad > $res->get("cantidad")){
        $InvBot->existencia = $InvBot->existencia + ($Bot->cantidad-$res->get("cantidad"));
      }else{
        $InvBot->existencia = $InvBot->existencia - ($Bot->cantidad-$res->get("cantidad"));
      }
      $InvBot->update();
      $Bot->cantidad = $res->get("cantidad");
      $Bot->costo = $res->get("costo");
      $Bot->update();
      $Factura = Ventas::findOrFail($res->get("factura"));
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','Vendido')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $Factura->total = $Total;
      $Factura->update();
    }

    public function EditarOrdenBotDel(Request $res){
      $Bot = VentaBot::findOrFail($res->get("id"));
      $InvBot = Botellas::findOrFail($Bot->id_botella);
      if($Bot->cantidad > $res->get("cantidad")){
        $InvBot->existencia = $InvBot->existencia + ($Bot->cantidad-$res->get("cantidad"));
      }else{
        $InvBot->existencia = $InvBot->existencia - ($Bot->cantidad-$res->get("cantidad"));
      }
      $InvBot->update();
      $Factura = Ventas::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($Bot->cantidad*$Bot->costo);
      $Bot->delete();
      $Factura->update();
    }

    //this

    public function EditarOrdenVentaGuardarCobrar(Request $res){
      $Mob = VentaMob::findOrFail($res->get("id"));
      $InvMob = Mobiliario::findOrFail($Mob->id_mob);
      if($Mob->cantidad > $res->get("cantidad")){
        $InvMob->existencia = $InvMob->existencia + ($Mob->cantidad-$res->get("cantidad"));
      }else{
        $InvMob->existencia = $InvMob->existencia - ($Mob->cantidad-$res->get("cantidad"));
      }
      $InvMob->update();
      $Mob->cantidad = $res->get("cantidad");
      $Mob->costo = $res->get("costo");
      $Mob->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"))->id_ventas;
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura)->where('estado','=','PorCobrar')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $SaveFactura = PorCobrar::findOrFail($Factura);
      $SaveFactura->total = $Total;
      $SaveFactura->update();
    }
    public function EditarOrdenVentaEliminarCobrar(Request $res){
      $CompraMob = VentaMob::findOrFail($res->get("id"));
      $InvMob = Mobiliario::findOrFail($CompraMob->id_mob);
      if($CompraMob->cantidad > $res->get("cantidad")){
        $InvMob->existencia = $InvMob->existencia + ($CompraMob->cantidad-$res->get("cantidad"));
      }else{
        $InvMob->existencia = $InvMob->existencia - ($CompraMob->cantidad-$res->get("cantidad"));
      }
      $InvMob->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($CompraMob->cantidad*$CompraMob->costo);
      $CompraMob->delete();
      $Factura->update();
    }

    public function EditarOrdenCosCobrar(Request $res){
      $Cos = VentaCos::findOrFail($res->get("id"));
      $InvCos = Cocina::findOrFail($Cos->id_cos);
      if($Cos->cantidad > $res->get("cantidad")){
        $InvCos->existencia = $InvCos->existencia + ($Cos->cantidad-$res->get("cantidad"));
      }else{
        $InvCos->existencia = $InvCos->existencia - ($Cos->cantidad-$res->get("cantidad"));
      }
      $InvCos->update();
      $Cos->cantidad = $res->get("cantidad");
      $Cos->costo = $res->get("costo");
      $Cos->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"));
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $Factura->total = $Total;
      $Factura->update();
    }

    public function EditarOrdenCosDelCobrar(Request $res){
      $Cos = VentaCos::findOrFail($res->get("id"));
      $InvCos = Cocina::findOrFail($Cos->id_cos);
      if($Cos->cantidad > $res->get("cantidad")){
        $InvCos->existencia = $InvCos->existencia + ($Cos->cantidad-$res->get("cantidad"));
      }else{
        $InvCos->existencia = $InvCos->existencia - ($Cos->cantidad-$res->get("cantidad"));
      }
      $InvCos->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($Cos->cantidad*$Cos->costo);
      $Cos->delete();
      $Factura->update();
    }

    public function EditarOrdenBotCobrar(Request $res){
      $Bot = VentaBot::findOrFail($res->get("id"));
      $InvBot = Botellas::findOrFail($Bot->id_botella);
      if($Bot->cantidad > $res->get("cantidad")){
        $InvBot->existencia = $InvBot->existencia + ($Bot->cantidad-$res->get("cantidad"));
      }else{
        $InvBot->existencia = $InvBot->existencia - ($Bot->cantidad-$res->get("cantidad"));
      }
      $InvBot->update();
      $Bot->cantidad = $res->get("cantidad");
      $Bot->costo = $res->get("costo");
      $Bot->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"));
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      $Factura->total = $Total;
      $Factura->update();
    }

    public function EditarOrdenBotDelCobrar(Request $res){
      $Bot = VentaBot::findOrFail($res->get("id"));
      $InvBot = Botellas::findOrFail($Bot->id_botella);
      if($Bot->cantidad > $res->get("cantidad")){
        $InvBot->existencia = $InvBot->existencia + ($Bot->cantidad-$res->get("cantidad"));
      }else{
        $InvBot->existencia = $InvBot->existencia - ($Bot->cantidad-$res->get("cantidad"));
      }
      $InvBot->update();
      $Factura = PorCobrar::findOrFail($res->get("factura"));
      $Factura->total = $Factura->total - ($Bot->cantidad*$Bot->costo);
      $Bot->delete();
      $Factura->update();
    }

    public function EditarOrdenCobrar($id){
      $Compra = PorCobrar::findOrFail($id);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$id)->where('estado','=','PorCobrar')->get();
      $Cliente = DB::table('clientes')->where('id_cliente','=',$Compra->id_cliente)->first();
      return view('Factura.Editor.VentaOrdenCobrar', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Cliente'=>$Cliente]);
    }

    public function GetTotalVendidoCobrar($id){
       $Factura = PorCobrar::findOrFail($id);
      $CompraMob = DB::table('venta_mob')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $CompraCos = DB::table('venta_cos')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $CompraBot = DB::table('venta_bot')->where('id_factura','=',$Factura->id_ventas)->where('estado','=','PorCobrar')->get();
      $Total = 0;
      foreach ($CompraMob as $mob) {
        $Total = $Total + ($mob->costo*$mob->cantidad);
      }
      foreach ($CompraCos as $cos) {
        $Total = $Total + ($cos->costo*$cos->cantidad);
      }
      foreach ($CompraBot as $bot) {
        $Total = $Total + ($bot->costo*$bot->cantidad);
      }
      return $Total;
    }
}
