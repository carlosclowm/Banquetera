<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Cocina;
use App\Http\Requests\CocinaRequest;
use DB;

class CocinaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$Cocina = DB::table('cocina')->orderBy('id_cocina', 'desc')->paginate(7);
    	return view('Inventario.Cocina.Listado', ['Cocina'=>$Cocina]);
    }
    public function Nuevo(){
    	return view('Inventario.Cocina.Nuevo');
    }
    public function Agregar(CocinaRequest $res){
    	$Cocina = new Cocina;
    	$Cocina->tipo = $res->get('tipo');
    	$Cocina->nombre = $res->get('nombre');
    	$Cocina->existencia = 0;
    	$Cocina->save();
    	return Redirect::to('/Inventario/Cocina');
    }
    public function AgregarToVentas(CocinaRequest $res){
        $Cocina = new Cocina;
        $Cocina->tipo = $res->get('tipo');
        $Cocina->nombre = $res->get('nombre');
        $Cocina->existencia = 0;
        $Cocina->save();
        return Redirect::Back();
    }

    public function CocinaEditar($id){
        $Cocina = Cocina::findOrFail($id);
        return view('Inventario.Cocina.Editar', ['Cocina'=>$Cocina]);
    }

    public function CocinaEdit(Request $res){
        $Cocina = Cocina::findOrFail($res->get('id'));
        $Cocina->tipo = $res->get('tipo');
        $Cocina->nombre = $res->get('nombre');
        $Cocina->update();
        return Redirect::to('/Inventario/Cocina');
    }
}
