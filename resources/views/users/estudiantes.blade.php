@extends('layouts.admin')
@section('content')
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Estudiantes</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Usuario</th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Apellidos</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($estudiantes as $docente)
	                                            <tr>
	                                                <td>{{$loop->iteration}}</td>
                                                    <td>{{$docente->usuario}}</td>
	                                                <td>{{$docente->name}}</td>	                                            
	                                                <td>{{$docente->last_name}}</td>	                                          
	                                                <td>{{$docente->email}}</td>	                                          
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

    