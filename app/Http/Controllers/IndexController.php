<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Consulta;

class IndexController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $user = Auth::user();
        $consultas_pendientes = array();
        $consultas_revisadas = array();
        if($user){
            if($user->hasRole('paciente')){ 
                $consultas_pendientes = Consulta::where('user_paciente_id',$user->id)->where('estado_consulta_id','1')->get();
                $consultas_revisadas = Consulta::where('user_paciente_id',$user->id)->where('estado_consulta_id','2')->get();
            }elseif($user->hasRole('medico')){
                $consultas_pendientes = Consulta::where('user_medico_id',$user->id)->where('estado_consulta_id','1')->get();
                $consultas_revisadas = Consulta::where('user_medico_id',$user->id)->where('estado_consulta_id','2')->get();
            }
        }

        return view('welcome',[
            'roles'=>$roles,
            'consultas_pendientes'=>$consultas_pendientes,
            'consultas_revisadas'=>$consultas_revisadas,
            ]);
    }

}
