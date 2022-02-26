<?php

namespace App\Http\Utils\Session;

use Illuminate\Support\Facades\Session;

class SessionMock
{
    public static function setMockSession() {
        Session::put('pegeId', 8124855);
    }
}
