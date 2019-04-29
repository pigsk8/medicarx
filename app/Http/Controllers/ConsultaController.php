<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiagnosticoRequest;
use App\Http\Requests\ConsultaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Consulta;
use App\Radiografia;
use App\Estudio;
use App\Mail\NotifyPac;
use App\Mail\NotifyDoc;

class ConsultaController extends Controller
{
    public function create()
    {
        $users = User::with("roles")->get();
        $estudios = Estudio::all();
        return view('consulta.create')
            ->with('users', $users)
            ->with('estudios', $estudios);
    }

    public function save(ConsultaRequest $request)
    {

        $files = $request->file('img-rad');

        if (isset($request->estudio) && isset($files)) {

            if (count($files) != count($request->estudio)) {
                return redirect()->back()->with('danger', 'Toda imagen radiografica debe tener un tipo de estudio asociado');
            } else {

                $consulta = new Consulta();
                $consulta->user_medico_id = $request->medico;
                $consulta->user_paciente_id = $request->paciente;
                $consulta->fecha_solicitud = date('Y-m-d H:i:s');
                $freepass = uniqid();
                $consulta->freepass = $freepass;
                $consulta->save();

                for ($i = 0; $i < count($files); $i++) {
                    $radiografia = new Radiografia();
                    $radiografia->consulta_id = $consulta->id;
                    $radiografia->ruta_img = $files[$i]->store('radiografias', 'public');
                    $radiografia->estudio_id = $request->estudio[$i];
                    $radiografia->save();
                }

                /**Enviar notificación a doctor por la consulta */
                $medico = User::find($request->medico);
                $data = array(
                    "name" => $medico->name
                );
                try {
                    Mail::to($medico->email)->send(new NotifyDoc($data));
                } catch (\Exception $e) { }

                return redirect()->back()->with('success', 'Consulta creada');
            }
        } else {
            return redirect()->back()->with('danger', 'Toda imagen radiografica debe tener un tipo de estudio asociado');
        }
    }

    public function list()
    {
        $consultas = Consulta::all();
        return view('consulta.list')->with('consultas', $consultas);
    }

    public function show(Consulta $consulta)
    {
        $user = Auth::user();
        if ($user->id == $consulta->user_paciente_id || $user->id == $consulta->user_medico_id || $user->hasRole('admin')) {
            return view('consulta.show')
                ->with('consulta', $consulta);
        } else {
            return redirect('/');
        }
    }

    public function showFree(Consulta $consulta, String $pass)
    {
        return view('consulta.show')
            ->with('consulta', $consulta);
        if ($consulta->freepass == $pass) {
            return view('consulta.show')
                ->with('consulta', $consulta);
        } else {
            return redirect('/');
        }
    }

    public function delete(Consulta $consulta)
    {
        $consulta->delete();
        return redirect()->back()->with('success', 'Consulta eliminada');
    }

    public function saveDiagnostico(DiagnosticoRequest $request, Consulta $consulta)
    {

        $consulta->fecha_entrega = date('Y-m-d H:i:s');
        $consulta->diagnostico = $request->diagnostico;
        $consulta->estado_consulta_id = 2;
        $consulta->save();

        /**Enviar notificación a doctor por la consulta */
        $paciente = User::find($consulta->user_paciente_id);
        $data = array(
            "name" => $paciente->name
        );
        try {
            Mail::to($paciente->email)->send(new NotifyPac($data));
        } catch (\Exception $e) { }

        return redirect()->back()->with('success', 'Diagnostico realizado');
    }
}
