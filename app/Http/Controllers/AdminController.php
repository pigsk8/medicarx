<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterAdminRequest;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function registro(RegisterAdminRequest $request){

        $new_user = new User();
        $new_user->name =  $request->input('name');
        $new_user->email =  $request->input('email');
        $new_user->username =  $request->input('username');
        $new_user->ci =  $request->input('ci');
        $new_user->password =  bcrypt($request->input('password'));
        $new_user->remember_token = $request->input('_token');
        $new_user->estado_usuario_id =  1;
        $new_user->save();

        $role_entry = Role::find($request->input('role'));

        $new_user->attachRole($role_entry);

        return redirect('/');
    }
}
