<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Hash;
use App\User;
use App\Role;
use App\Pregunta;
use App\EstadoUsuario;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function list()
    {
        $users = User::with('estado_usuario')->get();
        return view('perfil.list')
        ->with('users',$users);
    }

    public function show(User $user)
    {
        $questions = Pregunta::all();
        $estados  = EstadoUsuario::all();
        $roles = Role::all();
        $rol = $user->roles()->get()->toArray();
        $isAdmin = Auth::user()->hasRole('admin');
        if(count($user->preguntas)>0){
            $hasQuestions = true;
        }else{
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

    public function edit(Request $request){
        $userEdit = User::find($request->user_id);
        $userEdit->name = $request->name;
        $userEdit->email = $request->email;
        $userEdit->ci = $request->ci;
        $userEdit->username = $request->username;
        // $avatar = $request->avatar;
        // $userEdit->avatar = $avatar->store('users', 'public');

        $userEdit->save();

        $role_entry = Role::find($request->input('role'));

        
        if($role_entry){
            $userEdit->roles()->detach();
            $userEdit->attachRole($role_entry);
        }
        
        return redirect()->back()->with('message', 'Perfil Actualizado');
    }

    public function editPreguntas(Request $request){

        $userEdit = User::find($request->user_id);

        $userEdit->preguntas()->detach();
        $userEdit->preguntas()->attach(1, ['respuesta' => $request->pregunta1]);
        $userEdit->preguntas()->attach(2, ['respuesta' => $request->pregunta2]);
        $userEdit->preguntas()->attach(3, ['respuesta' => $request->pregunta3]);

        return redirect()->back()->with('message', 'Preguntas Actualizadas');
    }

    public function editEstado(Request $request){
        
        $userEdit = User::find($request->user_id);
        $userEdit->estado_usuario_id = $request->estado_user;
        $userEdit->save();

        return redirect()->back()->with('message', 'Estado Actualizado');

    }

    public function editPass(PasswordRequest $request){
        
        $user = User::find($request->user_id);

        if (Hash::check($request->old_password, $user->password)) {
            if($request->old_password == $request->password){
                return redirect()->back()->with('messagePass', 'La contraseña nueva no puede ser igual a la actual');
            }else{
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->back()->with('message', 'La contraseña ha sido actualizada');
            }
        }else{
            return redirect()->back()->with('messagePass', 'La contraseña actual no coincide');
        }
        die();

    }
}
