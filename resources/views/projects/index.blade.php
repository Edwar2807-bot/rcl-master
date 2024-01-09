@extends('layouts.admin')
@section('content')
<style type="text/css">
    .projects:hover {
  -webkit-box-shadow: 10px 10px 5px 0px rgba(208,212,242,1);
-moz-box-shadow: 10px 10px 5px 0px rgba(208,212,242,1);
box-shadow: 10px 10px 5px 0px rgba(208,212,242,1);
color: black;
    }

</style>
<div class="row">
<!-- Column -->
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card projects p-3" >
        <div class="card-body">
            <center class="">
                <h4 class="card-title">Control e Identificación de Sistemas</h4>
            </center>
        </div>
            <center>
                <img class="img-fluid" src="{{ asset('img/pid.png') }}">
               <p>
                   La actividad en el Laboratorio Remoto consiste en una práctica de determinación experimental de la función de transferencia de un péndulo invertido rotacional y el posterior diseño y comprobación del controlador PID
               </p>
               @if($showmotor)
               <form class="" action="{{ route('project1.validar') }}" method="POST">    
                            {{ csrf_field() }}    
                              
                                <button type="submit" class="btn btn-success">Continuar</button>
                </form>
              @else
                  <p style="color: red;">No tiene agenda para esta hora</p>
               @endif
            </center>
    </div>
</div> 
<!-- Column -->

<!-- 
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card projects p-3" >
        <div class="card-body">
            <center class="">
                <h4 class="card-title">Sensórica</h4>
            </center>
        </div>
            <center>
                {{--<img class="img-fluid" src="{{ asset('img/sensor.png') }}">
               @if($show2)
               <form class="" action="{{ route('project1.validar2') }}" method="POST">    
                            {{ csrf_field() }}    
                              
                                <button type="submit" class="btn btn-success">Continuar</button>
                </form>
              @else
                  <p style="color: red;">No tiene agenda para esta hora</p>
               @endif
            </center>
        --}}
    </div>
</div>
 -->

</div>

@endsection
