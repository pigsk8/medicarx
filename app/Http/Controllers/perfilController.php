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
        dd($request);
    }
}
