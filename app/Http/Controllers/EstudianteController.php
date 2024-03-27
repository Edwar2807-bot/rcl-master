<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;  // Importa el modelo User

class EstudianteController extends Controller
{   
    public function destroy($id)
    {
        // Encuentra el estudiante por ID y elimínalo
        $estudiante = User::findOrFail($id);
        $estudiante->delete();
        // Redirige a la página de estudiantes con un mensaje de éxito
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente');
    }
    
    public function showForm()
    {
        return view('estudiantes.registrar'); // Asegúrate de tener una vista para este formulario.
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario' => 'required',
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:4', // Asegúrate de tener un campo de contraseña en tu formulario.
        ]);

        // Crear un nuevo usuario (estudiante) en la base de datos
        User::insert([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'rol' => 3, 
            'creado' => 2, 
            'email_verified_at' => now(), 
            'password' => bcrypt($request->password),
            'remember_token' => \Str::random(10),  // Asegúrate de cifrar la contraseña antes de almacenarla.
            // Puedes agregar otros campos según sea necesario.
        ]);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado correctamente');
    }
}
