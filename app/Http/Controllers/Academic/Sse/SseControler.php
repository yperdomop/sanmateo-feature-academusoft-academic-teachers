<?php

namespace App\Http\Controllers\Academic\Sse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SseControler extends Controller
{
    public function indexSse(){
        return view('modules.sse.index',[]);
    }
}
