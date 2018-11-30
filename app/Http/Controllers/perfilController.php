<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Pregunta;
use Illuminate\Support\Facades\Auth;

class perfilController extends Controller
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
        $roles = Role::all();
        $rol = $user->roles()->get()->toArray();
        $isAdmin = Auth::user()->hasRole('admin');
        return view('perfil.showEdit')
        ->with('user', $user)
        ->with('isAdmin', $isAdmin)
        ->with('roles', $roles)
        ->with('rol', $rol)
        ->with('questions', $questions);
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
}
