<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Pregunta;

class perfilController extends Controller
{
    public function list()
    {
        $users = User::paginate(2);
        return view('perfil.list')
        ->with('users',$users);
    }

    public function show(User $user)
    {
        $questions = Pregunta::all();
        $roles = Role::all();
        return view('perfil.showEdit')
        ->with('user', $user)
        ->with('roles', $roles)
        ->with('questions', $questions);
    }

    public function edit(Request $request){
        $userEdit = User::find($request->user_id);
        $userEdit->name = $request->name;
        $userEdit->email = $request->email;
        $userEdit->ci = $request->ci;
        $userEdit->username = $request->username;
        $avatar = $request->avatar;
        $userEdit->avatar = $avatar->store('users', 'public');

        $userEdit->save();

        $role_entry = Role::find($request->input('role'));
        
        $userEdit->roles()->detach();
        $userEdit->attachRole($role_entry);

        $userEdit->preguntas()->detach();
        $userEdit->preguntas()->attach(1, ['respuesta' => $request->pregunta1]);
        $userEdit->preguntas()->attach(2, ['respuesta' => $request->pregunta2]);
        $userEdit->preguntas()->attach(3, ['respuesta' => $request->pregunta3]);

        return redirect('/perfil');
    }
}
