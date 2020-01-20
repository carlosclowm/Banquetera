<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MobiliarioRequest;
use App\Mobiliario;
use DB;

class MobiliarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$Mobiliario = DB::table('mobiliario')->orderBy('id_mob', 'desc')->paginate(7);
    	return view('Inventario.Mobiliario.Listado', ['Mobiliario'=>$Mobiliario]);
    }

    public function Nuevo(){
    	return view('Inventario.Mobiliario.Nuevo');
    }
    public function Agregar(MobiliarioRequest $res){
        $Mobiliario = new Mobiliario;
        $Mobiliario->tipo = $res->get('tipo');
        $Mobiliario->nombre = $res->get('nombre');
        $Mobiliario->existencia = 0;
        $Mobiliario->save();
        return Redirect::to('/Inventario/Mobiliario');
    }
    public function AgregarToVentas(MobiliarioRequest $res){
        $Mobiliario = new Mobiliario;
        $Mobiliario->tipo = $res->get('tipo');
        $Mobiliario->nombre = $res->get('nombre');
        $Mobiliario->existencia = 0;
        $Mobiliario->save();
        return Redirect::Back();
    }

    public function MobiliarioEditar($id){
        $Mobiliario = Mobiliario::findOrFail($id);
        return view('Inventario.Mobiliario.Editar', ['Mobiliario'=>$Mobiliario]);
    }

    public function MobiliarioEdit(Request $res){
        $Mobiliario = Mobiliario::findOrFail($res->get('id'));
        $Mobiliario->tipo = $res->get('tipo');
        $Mobiliario->nombre = $res->get('nombre');
        $Mobiliario->update();
        return Redirect::to('/Inventario/Mobiliario');
    }
}
