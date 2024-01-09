@extends('layouts.admin')
@section('content')

<div class="row">
<!-- Column -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <center class="m-t-10">
                <h4 class="card-title m-t-10">Control e Identificación de Sistema</h4>
            </center>
        </div>
        <div class="card-body">  
            <p>Este laboratorio proporciona el acceso a un sistema estandarizado de control de velocidad de un motor DC para que el estudiante afiance los conocimientos en el área de sistemas de control. La actividad en el Laboratorio Remoto consiste en una práctica de determinación experimental de la función de transferencia a un motor DC y el posterior diseño y comprobación del controlador PID para el mismo. En ella, el estudiante opera remotamente un motor DC, conectado a internet, que está configurado en lazo abierto. Para ello, dispone de una interfaz gráfica de usuario en donde se establece la entrada del sistema y se observa como respuesta la velocidad del motor. Posteriormente, con los datos adquiridos se determina la función de transferencia del sistema usando el método gráfico. Una vez se obtiene la función de transferencia del sistema, el estudiante sintoniza el controlador mediante la variación de los parámetros Kp, Ki, Kd.</p>

            <div class="d-flex justify-content-center">
               <form class="form-inline text-center" action="{{ route('project1.validar') }}" method="POST">    
                            {{ csrf_field() }}    
                              
                                <button type="submit" class="btn btn-success">Continue</button>
            </form>
        </div>
            
        </div>
    </div>
</div>
<!-- Column -->

</div>

@endsection


