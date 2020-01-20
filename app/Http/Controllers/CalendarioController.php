<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
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
                 $cl->hace = $cl->hace.$fecha->m.' meses ';
             }
             if(isset($fecha->d) && $fecha->d>0){
                 $cl->hace = $cl->hace.$fecha->d.' días ';
             }if(isset($fecha->h) && $fecha->h>0){
                 $cl->hace = $cl->hace.$fecha->h.' horas ';
             }if(isset($fecha->i) && $fecha->i>0){
                 $cl->hace = $cl->hace.$fecha->i.' min ';
             }if(isset($fecha->s) && $fecha->s>0 && $fecha->i<1){
                 $cl->hace = ' Ahora';
             }
    	}
    	 
    	return $Calendar;
    }
    public function index(){
        if (Auth::user()->hasRole('ADM')) {
           $Calendar = DB::table('calendario')->get();
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
            array_push($Tareas, ['title'=>$cl->titulo, 'start'=>$cl->fecha, 'backgroundColor'=>$Color, 'borderColor'=>$Color, 'name'=>$cl->nota]);
        }
        return view('Calendario.calendario', ['Tareas'=>json_encode($Tareas)]);
        }else{
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
            array_push($Tareas, ['title'=>$cl->titulo, 'start'=>$cl->fecha, 'backgroundColor'=>$Color, 'borderColor'=>$Color, 'name'=>$cl->nota]);
        }
        return view('Calendario.calendario', ['Tareas'=>json_encode($Tareas)]);
        }
    	
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
            $subject = $Evento->titulo;
            $for = $res->correo;
            $data = ['titulo'=>$res->titulo, 'nota'=>$res->nota, 'fecha'=>date('Y-m-d'), 'agendado'=>$res->fecha." ".$res->hora];
            Mail::send('Correo.Alerta',$data, function($msj) use($subject,$for){
            $msj->from("toriba.alertas@gmail.com","Alerta Toriba");
            $msj->subject($subject);
            $msj->to($for);
        });
    		return Redirect::back();
    	}else{
    		return Redirect::back()->withErrors('El Correo no Existe');
    	}
    	
    }
    public function test(Request $res){
        $data = ['titulo'=>'Titulo prueba', 'nota'=>'nota prueba', 'fecha'=>'2019-08-26', 'agendado'=>'fecha'];
         $subject = "Asunto del correo";
        $for = "carlosclowmtln@gmail.com";
        //return view('Correo.Alerta', $data);
        Mail::send('Correo.Alerta',$data, function($msj) use($subject,$for){
            $msj->from("toriba.alertas@gmail.com","Toriba Alertas");
            $msj->subject($subject);
            $msj->to($for);
        });
    }
}
