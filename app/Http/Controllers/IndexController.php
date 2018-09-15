<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class IndexController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('welcome',[
            'roles'=>$roles
            ]);
    }

}
