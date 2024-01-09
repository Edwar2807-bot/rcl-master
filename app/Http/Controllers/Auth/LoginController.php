<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {  
       return ['usuario' => strtolower($request->usuario), 'password' => $request->password];
    }

    
    public function username()
    {
        return 'usuario';
    }


    protected function validateLogin(Request $request)
    {
        //dd($request->usuario);
        $request->usuario = strtolower($request->usuario);
        $this->validate($request, [
            $this->username() => 'required|exists:pgsql.public.users,' . $this->username() . ',activo,TRUE',
            'password' => 'required',
        ], [
            $this->username() . '.exists' => 'El usuario no es válido o la cuenta ha sido deshabilitada.'
        ]);
    }
}
