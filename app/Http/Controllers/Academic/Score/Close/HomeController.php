<?php

namespace App\Http\Controllers\Academic\Score\Close;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Cierres';
        $rol = 'Administrador';
        return view('academic.score.close.index', compact('title', 'rol'));
    }
}
