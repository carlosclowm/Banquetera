<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Calendario;
use DB;

class CalendarioController extends Controller
{
    public function User(){
    	$Calendar = DB::table('calendario')->where('usuario','=',Auth::user()->id)->get();
    	foreach ($Calendar as $cl) {
    		$fecha1 = new \DateTime(date("Y-m-d H:i:s"));
        	 $fecha2 = new \DateTime($cl->fecha); 
             $fecha = $fecha1->diff($fecha2);
             $cl->hace = "";
             if(isset($fecha->y) && $fecha->y>0){
                 $cl->hace = $fecha->y.' años';
             }if(isset($fecha->m) && $fecha->m>0){
                 $cl->hace = $fecha->m.' meses ';
             }
             if(isset($fecha->d) && $fecha->d>0){
                 $cl->hace = $fecha->d.' días ';
             }if(isset($fecha->h) && $fecha->h>0){
                 $cl->hace = $fecha->h.' horas ';
             }if(isset($fecha->i) && $fecha->i>0){
                 $cl->hace = $fecha->i.' min ';
             }if(isset($fecha->s) && $fecha->s>0 && $fecha->i<1){
                 $cl->hace = ' Ahora';
             }
    	}
    	 
    	return $Calendar;
    }
    public function index(){
    	$Calendar = DB::table('calendario')->where('usuario','=',Auth::user()->id)->get();
    	$Tareas = array();
    	foreach ($Calendar as $cl) {
    		$Color = "";
    		if($cl->estado == "success"){
    			$Color = "#00a65a";
    		}if($cl->estado == "warning"){
    			$Color = "#f39c12";
    		}if($cl->estado == "danger"){
    			$Color = "#f56954";
    		}
    		array_push($Tareas, ['title'=>$cl->titulo, 'start'=>$cl->fecha, 'backgroundColor'=>$Color, 'borderColor'=>$Color]);
    	}
    	return view('Calendario.calendario', ['Tareas'=>json_encode($Tareas)]);
    }

    public function Agregar(Request $res){
    	$Destinatario = DB::table('users')->where('email','=',$res->correo)->first();
    	if($Destinatario){
    		$Evento = new Calendario;
    		$Evento->usuario = $Destinatario->id;
    		$Evento->fecha = $res->fecha." ".$res->hora;
    		$Evento->titulo = $res->titulo;
    		$Evento->nota = $res->nota;
    		$Evento->estado = $res->Prioridad;
    		$Evento->remitente = Auth::user()->id;
    		$Evento->save();
    		return Redirect::back();
    	}else{
    		return Redirect::back()->withErrors('El Correo no Existe');
    	}
    	
    }
}
