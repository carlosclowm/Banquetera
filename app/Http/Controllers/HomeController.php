<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Empleado', 'ADM', 'Cliente']);
        if($request->user()->hasRole('ADM')){
          $now = new \DateTime();
          $var = [];
          $Total = $var;
          array_push($Total, ['Meses', 'Ventas', 'Compras', 'Utilidades', 'Gastos']);
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
          $cont = 1;
          for($i = (int)$now->format("m"); $i>0; $i--){
            $M = $now->format("Y").'-'.$cont.'-01';
            //Total Para La Grafica Ventas
            $Ventas = DB::select('SELECT sum(total) as TOTAL from ventas WHERE MONTH(fecha) = MONTH("'.$M.'") AND YEAR(now())');
            $Ven = 0;
            foreach($Ventas as $vent){
              $Ven = $vent->TOTAL;
            }
            //Total Para La Grafica Compras
            $Compras = DB::select('SELECT sum(total) as TOTAL from compras WHERE MONTH(fecha) = MONTH("'.$M.'") AND YEAR(now())');
            $Com = 0;
            foreach($Compras as $comp){
              $Com = $comp->TOTAL;
            }
            //Total Para La Grafica Gastos
            $Gas = 0;
            //Total Para La Grafica Utilidades
            $Utl = $Ven-$Com-$Gas;

            //Envio a Grafica
            $var = [$meses[date('m')-$i], (int)$Ven, (int)$Com, (int)$Utl, (int)$Gas];
            array_push($Total, $var);
            $cont++;
          }

          return view('home', ['Grafica'=>$Total]);

        }
        if($request->user()->hasRole('Empleado')){
            return "Mantenimiento";
        }if($request->user()->hasRole('Cliente')){
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
          return view('Clientes.home', ['Tareas'=>json_encode($Tareas)]);
        }

    }

}
