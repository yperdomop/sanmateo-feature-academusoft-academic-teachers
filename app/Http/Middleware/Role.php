<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Role {
    
  public function handle($request, Closure $next, String $apli_id, String $func_id = null) {
    $user = Auth::user();
    $applications = User::getApplicationUserId($user->usua_id, $apli_id);
    $functions = User::getFunctionsUserId($user->usua_id, $func_id);
    $valid = false;
    if(!$applications->isEmpty()){
        $valid = true;
        if($func_id != NULL){
            if($functions->isEmpty())
                $valid = false;
        }
    }
    if($valid)
        return $next($request);

    return redirect('login');
  }
}