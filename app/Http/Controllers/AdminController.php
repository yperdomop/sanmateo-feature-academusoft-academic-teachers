<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function user_rol(){
        return view('dashboard.user_rol')->with('roles', Admin::getRoles());
    }
    function rol_aplicacion(){
        return view('dashboard.rol_aplicacion')->with('roles', Admin::getRoles())
                                                ->with('aplicaciones', Admin::getAplications());
    }
    function apli_func_rol(){
        return view('dashboard.apli_func_rol')->with('roles', Admin::getRoles())
                                              ->with('aplicaciones', Admin::getAplications());
    }
}
