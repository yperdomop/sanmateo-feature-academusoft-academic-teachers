<?php

namespace App\Http\Controllers\Academic\Score\Close;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic\Unidad;

class CierresController extends Controller
{
    public function index()
    {
        $title = 'Cierres';
        $rol = 'Administrador';
        return view('academic.score.close.index', compact('title', 'rol'));
    }

    public function period()
    {
        $title = 'Cerrar periodo';
        $rol = 'Administrador';
        return view('academic.score.close.period', compact('title', 'rol'));
    }
}
