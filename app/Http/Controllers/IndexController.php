<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class IndexController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $roles = Role::all();
        return view('welcome',[
            'user'=>$user,
            'roles'=>$roles
            ]);
    }

}
