<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Consulta;
use App\Radiografia;
use App\Estudio;
use Carbon\Carbon;


class ReporteController extends Controller
{
    public function index(){

        /**Cantidades de radiografías */

        $date = Carbon::now();
        $today = $date->format('Y-m-d');
        $week = $date->subDays(7)->format('Y-m-d');
        $month = $date->subDays(30)->format('Y-m-d');

        $consultas = Consulta::where('fecha_solicitud','>=',$month)->with('radiografias.estudio')->get();

        $consultas_today = $consultas->where('fecha_solicitud',$today);
        $array_estudios = [];
        foreach($consultas_today as $key => $value){
            foreach($value->radiografias as $radiografia){
                array_push($array_estudios,$radiografia->estudio->descripcion);
            }
        }
        $count_today = count($array_estudios);
        $vals_today = array_count_values($array_estudios);

        $consultas_week = $consultas->where('fecha_solicitud','>=',$week);
        $array_estudios = [];
        foreach($consultas_week as $key => $value){
            foreach($value->radiografias as $radiografia){
                array_push($array_estudios,$radiografia->estudio->descripcion);
            }
        }
        $count_week = count($array_estudios);
        $vals_week = array_count_values($array_estudios);

        $array_estudios = [];
        foreach($consultas as $key => $value){
            foreach($value->radiografias as $radiografia){
                array_push($array_estudios,$radiografia->estudio->descripcion);
            }
        }
        $count_month = count($array_estudios);
        $vals_month = array_count_values($array_estudios);
        
        /**Cantidades de usuarios por rol */

        $usuarios = User::with('roles')->get();

        $array_usuarios = [];
        foreach($usuarios as $key => $value){
            foreach($value->roles as $rol){
                if($rol->name != 'admin'){
                    array_push($array_usuarios,$rol->name);
                }
            }
        }
        $count_user = count($array_usuarios);
        $vals_user = array_count_values($array_usuarios);

        return view('reporte.index',[
            'estudios_today'=>$vals_today,
            'count_today'=>$count_today,
            'estudios_week'=>$vals_week,
            'count_week'=>$count_week,
            'estudios_month'=>$vals_month,
            'count_month'=>$count_month,
            'list_user'=>$vals_user,
            'count_user'=>$count_user
            ]);
    }
}
