<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
class UserController extends Controller
{
    function index(){
        return view('dashboard.index')->with('roles', User::getRoleUser());
    }
    function admin(){
        return view('dashboard.admin')
                ->with('aplicaciones', Admin::getAplications())
                ->with('roles', Admin::getRoles());
    }
    function validate_session_api(){
        return response(['message'=>'valido']);
    }
}
