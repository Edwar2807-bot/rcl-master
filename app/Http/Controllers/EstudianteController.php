<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;  // Importa el modelo User

class EstudianteController extends Controller
{
    public function showForm()
    {
        return view('estudiantes.registrar'); // Asegúrate de tener una vista para este formulario.
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6', // Asegúrate de tener un campo de contraseña en tu formulario.
        ]);

        // Crear un nuevo usuario (estudiante) en la base de datos
        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Asegúrate de cifrar la contraseña antes de almacenarla.
            // Puedes agregar otros campos según sea necesario.
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado correctamente');
    }
}

