<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiagnosticoRequest;
use App\Http\Requests\ConsultaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function save(ConsultaRequest $request){

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

        return response()->json(['success'=>'Consulta creada']);
    }

    public function list(){
        $consultas = Consulta::all();
        return view('consulta.list')->with('consultas',$consultas);
    }

    public function show(Consulta $consulta)
    {
        $user = Auth::user();
        if($user->id == $consulta->user_paciente_id || $user->id == $consulta->user_medico_id || $user->hasRole('admin')){
            return view('consulta.show')
            ->with('consulta', $consulta);
        }else{
            return redirect('/');
        }
    }

    public function delete(Consulta $consulta){
        $consulta->delete();
        return redirect()->back()->with('success', 'Consulta eliminada');
    }

    public function saveDiagnostico(DiagnosticoRequest $request, Consulta $consulta){

        $consulta->fecha_entrega = date('Y-m-d H:i:s');
        $consulta->diagnostico = $request->diagnostico;
        $consulta->estado_consulta_id = 2;
        $consulta->save();

        return redirect()->back()->with('success', 'Diagnostico realizado');

    }

}
