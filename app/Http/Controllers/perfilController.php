<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RegisterAdminRequest;
use Hash;
use App\User;
use App\Role;
use App\Pregunta;
use App\Consulta;
use App\EstadoUsuario;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function list()
    {
        $users = User::with('estado_usuario')->get();
        return view('perfil.list')
            ->with('users', $users);
    }

    public function show(User $user)
    {
        $questions = Pregunta::all();
        $estados = EstadoUsuario::all();
        $roles = Role::all();
        $rol = $user->roles()->get()->toArray();
        $isAdmin = Auth::user()->hasRole('admin');
        if (count($user->preguntas) > 0) {
            $hasQuestions = true;
        } else {
            $hasQuestions = false;
        }
        return view('perfil.showEdit')
            ->with('user', $user)
            ->with('isAdmin', $isAdmin)
            ->with('roles', $roles)
            ->with('rol', $rol)
            ->with('estados', $estados)
            ->with('questions', $questions)
            ->with('hasQuestions', $hasQuestions);
    }

    public function edit(RegisterAdminRequest $request)
    {
        $userEdit = User::find($request->user_id);
        $role_entry = Role::find($request->input('role'));
        $consultasUser = Consulta::where('user_medico_id', $userEdit->id)
        ->orwhere('user_paciente_id', $userEdit->id)->get();

        $userEdit->name = $request->name;
        $userEdit->email = $request->email;
        $userEdit->ci = $request->ci;
        $userEdit->username = $request->username;
        
        if($userEdit->roles[0]->id != $request->input('role')){
            if( count($consultasUser) > 0){
                return redirect()->back()->with('warning', 'Usuario no puede modificar su rol y se encuentra asociado a consultas');
            }else{
                $userEdit->save();
                if ($role_entry) {
                    $userEdit->roles()->detach();
                    $userEdit->attachRole($role_entry);
                }
            }
        }else{
            $userEdit->save();
            if ($role_entry) {
                $userEdit->roles()->detach();
                $userEdit->attachRole($role_entry);
            }
        }

        return redirect()->back()->with('message', 'Perfil Actualizado');
    }

    public function editPreguntas(Request $request)
    {

        $userEdit = User::find($request->user_id);

        $userEdit->preguntas()->detach();
        $userEdit->preguntas()->attach(1, ['respuesta' => $request->pregunta1]);
        $userEdit->preguntas()->attach(2, ['respuesta' => $request->pregunta2]);
        $userEdit->preguntas()->attach(3, ['respuesta' => $request->pregunta3]);

        return redirect()->back()->with('message', 'Preguntas Actualizadas');
    }

    public function editEstado(Request $request)
    {

        $userEdit = User::find($request->user_id);
        $userEdit->estado_usuario_id = $request->estado_user;
        $userEdit->save();

        return redirect()->back()->with('message', 'Estado Actualizado');

    }

    public function editPass(PasswordRequest $request)
    {

        $user = User::find($request->user_id);

        if (Hash::check($request->old_password, $user->password)) {
            if ($request->old_password == $request->password) {
                return redirect()->back()->with('messagePass', 'La contraseña nueva no puede ser igual a la actual');
            } else {
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->back()->with('message', 'La contraseña ha sido actualizada');
            }
        } else {
            return redirect()->back()->with('messagePass', 'La contraseña actual no coincide');
        }
        die();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            if ($user->hasRole('paciente')) {
                $consultas = Consulta::where('user_paciente_id', $user->id)->get();
                if (count($consultas) > 0) {
                    return redirect()->back()->with('warning', 'Usuario no se puede eliminar, se encuentra asociado a consultas');
                } else {
                    $user->delete();
                    return redirect()->back()->with('success', 'Usuario eliminado');
                }
            } else if ($user->hasRole('medico')) {
                $consultas = Consulta::where('user_medico_id', $user->id)->get();
                if (count($consultas) > 0) {
                    return redirect()->back()->with('warning', 'Usuario no se puede eliminar, se encuentra asociado a consultas');
                } else {
                    $user->delete();
                    return redirect()->back()->with('success', 'Usuario eliminado');
                }
            } else {
                $user->delete();
                return redirect()->back()->with('success', 'Usuario eliminado');
            }
        } else {
            return redirect()->back()->with('danger', 'Ha ocurrido un error, actualiza y vuelve a intentar');
        }

    }

    public function showHistoria(User $user){
        if ($user->hasRole('paciente')) {
            $consultas = Consulta::where('user_paciente_id', $user->id)
            ->with('estado_consulta')->with('radiografias')
            ->orderby('id','desc')->get();
            return view('perfil.historia')
            ->with('consultas', $consultas)
            ->with('user',$user);
        }else{
            return redirect('/');
        }
    }


}
