<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Cliente;
use App\Proveedor;
use DB;

class UsuariosController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function Clientes(){
    $Clientes = DB::table('clientes')->orderBy('id_cliente', 'desc')->paginate(7);
    return view('Usuarios.Clientes.Listado', ['Clientes'=>$Clientes]);
  }
  public function ClientesNuevo(){
    return view('Usuarios.Clientes.Nuevo');
  }
  public function ClientesNuevoAgregar(Request $res){
    $Cliente = new Cliente;
    $Cliente->nombre = $res->get('nombre');
    $Cliente->domicilio = $res->get('domicilio');
    $Cliente->telefono = $res->get('telefono');
    $Cliente->correo = $res->get('correo');
    $Cliente->save();
    return Redirect::to('/Clientes');
  }

  public function Proveedores(){
    $Proveedores = DB::table('proveedores')->orderBy('id_proveedor', 'desc')->paginate(7);
    return view('Usuarios.Proveedores.Listado', ['Proveedores'=>$Proveedores]);
  }
  public function ProveedoresNuevo(){
    return view('Usuarios.Proveedores.Nuevo');
  }
  public function ProveedoresNuevoAgregar(Request $res){
    $Proveedor = new Proveedor;
    $Proveedor->nombre = $res->get('nombre');
    $Proveedor->empresa = $res->get('empresa');
    $Proveedor->rfc = $res->get('rfc');
    $Proveedor->telefono = $res->get('telefono');
    $Proveedor->save();
    return Redirect::to('/Proveedores');

  }

  public function ClientesEditar($id){
    $Cliente = DB::table('clientes')->where('id_cliente','=',$id)->first();
    return view('Usuarios.Clientes.Editar', ['Cliente'=>$Cliente]);
  }

  public function ClienteEdit(Request $res){
    $Cliente = Cliente::findOrFail($res->get('id'));
    $Cliente->nombre = $res->get('nombre');
    $Cliente->domicilio = $res->get('domicilio');
    $Cliente->telefono = $res->get('telefono');
    $Cliente->correo = $res->get('correo');
    $Cliente->update();
    return Redirect::to('/Clientes');
  }

  public function ProveedoresEditar($id){
    $Proveedor = Proveedor::findOrFail($id);
    return view('Usuarios.Proveedores.Editar', ['Proveedor'=>$Proveedor]);
  }

  public function ProveedoresEdit(Request $res){
    $Proveedor = Proveedor::findOrFail($res->get('id'));
    $Proveedor->nombre = $res->get('nombre');
    $Proveedor->empresa = $res->get('empresa');
    $Proveedor->rfc = $res->get('rfc');
    $Proveedor->telefono = $res->get('telefono');
    $Proveedor->update();
    return Redirect::to('/Proveedores');
  }
}
