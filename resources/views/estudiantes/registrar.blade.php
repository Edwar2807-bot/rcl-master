@extends('layouts.admin') <!-- Asegúrate de que esta vista extienda el layout adecuado -->

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrar Estudiante</h4>
                
                <!-- Formulario de registro -->
                <form action="{{ route('estudiantes.store') }}" method="POST">
                    @csrf <!-- Directiva CSRF para protección contra ataques de falsificación de solicitudes entre sitios -->
                    
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Nombres</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Apellidos</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
