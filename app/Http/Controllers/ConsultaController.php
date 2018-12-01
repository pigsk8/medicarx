<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Consulta;
use App\Radiografia;
use App\Estudio;

class ConsultaController extends Controller
{
    public function create(){
        $users = User::with("roles")->get();
        $estudios = Estudio::all();
        return view('consulta.create')
        ->with('users',$users)
        ->with('estudios',$estudios);
    }

    public function save(Request $request){

        $consulta = new Consulta();
        $consulta->user_medico_id = $request->medico;
        $consulta->user_paciente_id = $request->paciente;
        $consulta->fecha_solicitud = date('Y-m-d H:i:s');
        $consulta->save();

        $image = $request->file('img-rad');
        
        $radiografia = new Radiografia();
        $radiografia->ruta_img = $image->store('radiografias', 'public');
        $radiografia->consulta_id = $consulta->id;
        $radiografia->estudio_id = $request->estudio;
        $radiografia->save();

        return redirect()->back()->with('success', 'Consulta Creada');
    }
}
