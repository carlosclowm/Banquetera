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
use App\CompraMob;
use App\CompraCos;
use App\CompraBot;
use App\Compras;
use App\DevoMob;
use App\DevoCos;
use App\DevoBot;
use App\Devoluciones;
use App\PorPagar;
use DB;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Comprar(){
      $Proveedor = DB::table('proveedores')->get();
    	$Mobiliario = DB::table('mobiliario')->get();
    	$Cocina = DB::table('cocina')->get();
    	$Botella = DB::table('botellas')->get();
    	$Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Compras')->get();
    	$Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
    	$Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      //total
      $Total = 0;
      foreach($Carrito_Mob as $Mob){
        $Total = $Total + $Mob->costo;
      }
      foreach($Carrito_Cos as $Cos){
        $Total = $Total + $Cos->costo;
      }
      foreach($Carrito_Bot as $Bot){
        $Total = $Total + $Bot->costo;
      }
    	return view('Inventario.Compras.Comprar', ['Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botella'=>$Botella,
      'Carrito_Mob'=>$Carrito_Mob, 'Carrito_Cos'=>$Carrito_Cos, 'Carrito_Bot'=>$Carrito_Bot, 'Total'=>$Total, 'Proveedores'=>$Proveedor]);
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
    	$Carrito->seccion = 'Compras';
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
    	$Carrito->seccion = 'Compras';
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
    	$Carrito->seccion = 'Compras';
    	$Carrito->save();
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
    public function Realizar($ProveedorID){
      $ID_MAX = DB::table('compras')->max('id_compras') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Compras')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new CompraMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "Comprado";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $update = Mobiliario::findOrFail($mob->id_mob);
          $update->existencia = $update->existencia + $mob->cantidad;
          $update->costo = $CompraMob->costo/$CompraMob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new CompraCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "Comprado";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $update = Cocina::findOrFail($cos->id_cocina);
          $update->existencia = $update->existencia + $cos->cantidad;
          $update->costo = $CompraCos->costo/$CompraCos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new CompraBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "Comprado";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $update = Botellas::findOrFail($bot->id_botella);
          $update->existencia = $update->existencia + $bot->cantidad;
          $update->costo = $CompraBot->costo/$CompraBot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + $Mob->costo;
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + $Cos->costo;
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + $Bot->costo;
        }
        //endtotal
        $Compra = new Compras;
        $Compra->id_proveedor = $ProveedorID;
        $Proveedor = DB::table('proveedores')->where('id_proveedor','=',$ProveedorID)->first();
        $Compra->nombre_proveedor = $Proveedor->nombre;
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->save();
        return view('Factura.Compra', ['Factura'=>$Compra]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }

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
    public function NotaCompra($Factura){
      $Compra = Compras::findOrFail($Factura);
      $Proveedor = DB::table('proveedores')->where('id_proveedor','=',$Compra->id_proveedor)->first();
      $CompraMob = DB::table('compra_mob')->where('id_factura','=',$Factura)->where('estado','=','Comprado')->get();
      $CompraCos = DB::table('compra_cos')->where('id_factura','=',$Factura)->where('estado','=','Comprado')->get();
      $CompraBot = DB::table('compra_bot')->where('id_factura','=',$Factura)->where('estado','=','Comprado')->get();
      return view('Factura.CompraFactura', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Proveedor'=>$Proveedor]);
    }

    public function Devolver(){
      $Proveedor = DB::table('proveedores')->get();
    	$Mobiliario = DB::table('mobiliario')->get();
    	$Cocina = DB::table('cocina')->get();
    	$Botella = DB::table('botellas')->get();
    	$Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Compras')->get();
    	$Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
    	$Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      //total
      $Total = 0;
      foreach($Carrito_Mob as $Mob){
        $Total = $Total + $Mob->costo;
      }
      foreach($Carrito_Cos as $Cos){
        $Total = $Total + $Cos->costo;
      }
      foreach($Carrito_Bot as $Bot){
        $Total = $Total + $Bot->costo;
      }
    	return view('Inventario.Compras.Devolver', ['Mobiliario'=>$Mobiliario, 'Cocina'=>$Cocina, 'Botella'=>$Botella,
      'Carrito_Mob'=>$Carrito_Mob, 'Carrito_Cos'=>$Carrito_Cos, 'Carrito_Bot'=>$Carrito_Bot, 'Total'=>$Total, 'Proveedores'=>$Proveedor]);
    }

    public function DevolverCompra(Request $res){
      $ID_MAX = DB::table('devoluciones')->max('id_compras') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Compras')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new DevoMob;
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
          $update->existencia = $update->existencia - $mob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new DevoCos;
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
          $update->existencia = $update->existencia - $cos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new DevoBot;
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
          $update->existencia = $update->existencia - $bot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + $Mob->costo;
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + $Cos->costo;
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + $Bot->costo;
        }
        //endtotal
        $Compra = new Devoluciones;
        $Compra->id_proveedor = $res->get('id');
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->razon = $res->get('razon');
        $Compra->save();
        return view('Factura.Devolucion', ['Factura'=>$Compra]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }
    }
    public function NotaDevuelto($Factura){
      $Compra = Devoluciones::findOrFail($Factura);
      $Proveedor = DB::table('proveedores')->where('id_proveedor','=',$Compra->id_proveedor)->first();
      $CompraMob = DB::table('compra_mob')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      $CompraCos = DB::table('compra_cos')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      $CompraBot = DB::table('compra_bot')->where('id_factura','=',$Factura)->where('estado','=','Devuelto')->get();
      return view('Factura.DevolucionFactura', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Proveedor'=>$Proveedor]);
    }

    public function PorPagar(Request $res){
      $ID_MAX = DB::table('por_pagar')->max('id_compras') + 1;
      $Carrito_Mob = DB::table('carrito_mobiliario')->where('token','=',csrf_token())->where('seccion','=','Compras')->get();
      $Carrito_Cos = DB::table('carrito_cocina')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      $Carrito_Bot = DB::table('carrito_botellas')->where('token','=',csrf_token())->where('seccion', '=', 'Compras')->get();
      if($Carrito_Bot->count() > 0 || $Carrito_Cos->count() > 0 || $Carrito_Mob->count() > 0){
        $now = new \DateTime;
        $Fecha = $now->format('Y-m-d H:i:s');
        //Mobiliario
        foreach ($Carrito_Mob as $mob) {
          $CompraMob = new CompraMob;
          $CompraMob->id_mob = $mob->id_mob;
          $CompraMob->id_factura = $ID_MAX;
          $CompraMob->estado = "PorPagar";
          $CompraMob->tipo = $mob->tipo;
          $CompraMob->nombre = $mob->nombre;
          $CompraMob->cantidad = $mob->cantidad;
          $CompraMob->costo = $mob->costo;
          $CompraMob->fecha = $Fecha;
          $CompraMob->save();
          $update = Mobiliario::findOrFail($mob->id_mob);
          $update->existencia = $update->existencia + $mob->cantidad;
          $update->costo = $CompraMob->costo/$CompraMob->cantidad;
          $update->update();
          $delete = CarritoMob::findOrFail($mob->id_carrito);
          $delete->delete();
        }
        //Cocina
        foreach ($Carrito_Cos as $cos) {
          $CompraCos = new CompraCos;
          $CompraCos->id_cos = $cos->id_cocina;
          $CompraCos->id_factura = $ID_MAX;
          $CompraCos->estado = "PorPagar";
          $CompraCos->tipo = $cos->tipo;
          $CompraCos->nombre = $cos->nombre;
          $CompraCos->cantidad = $cos->cantidad;
          $CompraCos->costo = $cos->costo;
          $CompraCos->fecha = $Fecha;
          $CompraCos->save();
          $update = Cocina::findOrFail($cos->id_cocina);
          $update->existencia = $update->existencia + $cos->cantidad;
          $update->costo = $CompraCos->costo/$CompraCos->cantidad;
          $update->update();
          $delete = CarritoCos::findOrFail($cos->id_carrito);
          $delete->delete();
        }
        //Botellas
        foreach ($Carrito_Bot as $bot) {
          $CompraBot = new CompraBot;
          $CompraBot->id_botella = $bot->id_botella;
          $CompraBot->id_factura = $ID_MAX;
          $CompraBot->estado = "PorPagar";
          $CompraBot->categoria = $bot->categoria;
          $CompraBot->nombre = $bot->nombre;
          $CompraBot->capacidad = $bot->capacidad;
          $CompraBot->cantidad = $bot->cantidad;
          $CompraBot->costo = $bot->costo;
          $CompraBot->fecha = $Fecha;
          $CompraBot->save();
          $update = Botellas::findOrFail($bot->id_botella);
          $update->existencia = $update->existencia + $bot->cantidad;
          $update->costo = $CompraBot->costo/$CompraBot->cantidad;
          $update->update();
          $delete = CarritoBot::findOrFail($bot->id_carrito);
          $delete->delete();
        }
        //total
        $Total = 0;
        foreach($Carrito_Mob as $Mob){
          $Total = $Total + $Mob->costo;
        }
        foreach($Carrito_Cos as $Cos){
          $Total = $Total + $Cos->costo;
        }
        foreach($Carrito_Bot as $Bot){
          $Total = $Total + $Bot->costo;
        }
        //endtotal
        $Compra = new PorPagar;
        $Compra->id_proveedor = $res->get('id');
        $Proveedor = DB::table('proveedores')->where('id_proveedor','=',$res->get('id'))->first();
        $Compra->nombre_proveedor = $Proveedor->nombre;
        $Compra->fecha = $Fecha;
        $Compra->total = $Total;
        $Compra->abonado = $res->get('abono');
        $Compra->save();
        $Deuda = $Total - $res->get('abono');
        return view('Factura.CompraPorPagar', ['Factura'=>$Compra, 'Deuda'=>$Deuda]);

      }else{
        return Redirect::back()->withErrors('El Carrito Esta Vacio');
      }

    }

    public function PorPagarNota($Factura){
      $Compra = PorPagar::findOrFail($Factura);
      $Proveedor = DB::table('proveedores')->where('id_proveedor','=',$Compra->id_proveedor)->first();
      $CompraMob = DB::table('compra_mob')->where('id_factura','=',$Factura)->where('estado','=','PorPagar')->get();
      $CompraCos = DB::table('compra_cos')->where('id_factura','=',$Factura)->where('estado','=','PorPagar')->get();
      $CompraBot = DB::table('compra_bot')->where('id_factura','=',$Factura)->where('estado','=','PorPagar')->get();
      return view('Factura.CompraFacturaPorPagar', ['Compra'=>$Compra, 'Mobiliario'=>$CompraMob, 'Cocina'=>$CompraCos, 'Botella'=>$CompraBot, 'Proveedor'=>$Proveedor]);
    }
}
