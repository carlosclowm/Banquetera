<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\BotellasRequest;
use App\Botellas;
use DB;

class BotellasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$Botellas = DB::table('botellas')->orderBy('id_botella', 'desc')->paginate(7);
    	return view('Inventario.Botellas.Listado', ['Botellas'=>$Botellas]);
    }
    public function Nuevo(){
    	return view('Inventario.Botellas.Nuevo');
    }
    public function Agregar(BotellasRequest $res){
    	$Botella = new Botellas;
    	$Botella->categoria = $res->get('categoria');
    	$Botella->nombre = $res->get('nombre');
    	$Botella->capacidad = $res->get('capacidad');
    	$Botella->existencia = 0;
    	$Botella->save();
    	return Redirect::to('/Inventario/Botellas');
    }

    public function BotellaEditar($id){
        $Botella = Botellas::findOrFail($id);
        return view('Inventario.Botellas.Editar', ['Botella'=>$Botella]);
    }
    public function BotellaEdit(Request $res){
        $Botella = Botellas::findOrFail($res->get('id'));
        $Botella->categoria = $res->get('categoria');
        $Botella->nombre = $res->get('nombre');
        $Botella->capacidad = $res->get('capacidad');
        $Botella->update();
        return Redirect::to('/Inventario/Botellas');
    }
}
