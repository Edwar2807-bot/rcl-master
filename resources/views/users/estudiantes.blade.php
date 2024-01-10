@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Estudiantes</h4>
                
                <!-- Botón para dirigir al formulario de registro de estudiante -->
                <div class="mb-3">
                    <a href="{{ route('estudiantes.registrar') }}" class="btn btn-primary">Agregar Estudiante</a>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acciones</th> <!-- Nueva columna para el botón de eliminar -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $estudiante->usuario }}</td>
                                    <td>{{ $estudiante->name }}</td>
                                    <td>{{ $estudiante->last_name }}</td>
                                    <td>{{ $estudiante->email }}</td>
                                    <td>
                                        <!-- Botón para eliminar un estudiante específico -->
                                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    