<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['docentes']);

    }


    public function docentes(Request $Request)
    {

        $docentes = User::where('rol',2)->paginate(10);
        return view('users.docentes',compact('docentes'));
        
    }

     public function estudiantes(Request $request)
    {
       
            $estudiantes = User::where('rol',3)->get();
 
        return view('users.estudiantes',compact('estudiantes'));
        
    }

    public function testCrear()
    {

        User::insert([
            'name' => "erick", 
            'last_name' => "pinzon", 
            'email' => "erick.pinzon@unillanos.edu.co", 
            'usuario' => "erick.pinzon", 
            'rol' => 3, 
            'creado' => 2, 
            'email_verified_at' => now(), 
            'password' => \Hash::make('161002121'), 
            'remember_token' => \Str::random(10), 
        ]);

        User::insert([
            'name' => "laura", 
            'last_name' => "herrera", 
            'email' => "laura.herrera.medina@unillanos.edu.co", 
            'usuario' => "laura.herrera.medina", 
            'rol' => 3, 
            'creado' => 2, 
            'email_verified_at' => now(), 
            'password' => \Hash::make('867000008'), 
            'remember_token' => \Str::random(10), 
        ]);
    }
}
