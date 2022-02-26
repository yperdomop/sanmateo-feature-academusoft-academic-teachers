<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use App\Models\PasswordResets;
use App\Models\PersonaGeneral;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * Write code on Method
     *
     * @return response()
    */
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
    */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $msg = 'Este usuario no se ha encontrado!';
        $obj_user = PersonaGeneral::where('pege_mail', $request->email);
        if($obj_user->exists()){
            $token = Str::random(64);
            PasswordResets::insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);
            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            $msg = 'Hemos enviado un link al correo !';
        } 
        return back()->with('message', $msg);
    }
    /**
     * Write code on Method
     *
     * @return response()
    */
    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
    */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $msg =  'Este usuario no se ha encontrado!';
        $obj_user = PersonaGeneral::where('pege_mail', $request->email);
        if($obj_user->exists()){
            $updatePassword = DB::table('general.password_resets')
                        ->where([
                        'email' => $request->email, 
                        'token' => $request->token
                        ])
                        ->first();

            if(!$updatePassword){
                return back()->withInput()->with('error', 'Token Invalido!');
            }
            $pege = PersonaGeneral::getPegeEmail($request->email);

            User::where('PEGE_ID', $pege->pege_id)->update(['password' => Hash::make($request->password)]);

            DB::table('general.password_resets')->where(['email'=> $request->email])->delete();
            $msg = 'Tu contraseña ha sido cambiada!';
        }
        
        return redirect('/login')->with('message', $msg);
    }
}
