@extends('layouts.admin')

@section('content')

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css' />
<style type="text/css">
   .fc-widget-content{
    height: 25px !important;
}
</style>
<div class="row">
<!-- Column -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <center class="m-t-10">
                <h2 class="card-title m-t-10">Agenda</h2>
            </center>
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Laboratorio</label>
  </div>
  <select class="custom-select col-4" name="laboratorio" id="laboratorio">
    <option value="1" @if ($lab == 1) selected @endif >Control e Identificación de Sistemas</option>
  <!--{{--<option value="2" @if ($lab ==2) selected @endif >Sensórica</option>
    <option value="3" @if ($lab ==3) selected @endif >Manejo de Variador de Frecuencia</option>--}}-->
  </select>
</div>


            <div id='calendar'></div>
        </div>

    </div>
</div>
<!-- Column -->
    
<div class="modal" tabindex="-1" role="dialog" id="modalAgenda">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ route('appointments.store') }}" method="POST" role="form" id="formAgendar">
      <div class="modal-header  ">
        <h4 class="modal-title  w-100 text-center">Agendar Servicio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


    {{ csrf_field() }}

    <b><p id="l_laboratorio" class="text-center"></p></b>
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless">
  <tbody>
    <tr>
        <th scope="row">Dia</th>
        <th scope="row" >Hora Inicio</th>
        <th scope="row" >Hora Fin</th>
    </tr>
    <tr>

      <td id="dia"></td>
      <td id="h_ini"></td>
      <td id="h_fin"></td>
    </tr>

  </tbody>
</table>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

    
<div class="modal" tabindex="-1" role="dialog" id="modalAgendaEliminar">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="" method="POST" role="form" id="formEliminar">
      <div class="modal-header  ">
        <h4 class="modal-title  w-100 text-center">Eliminar Agenda</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  @method('DELETE')

    {{ csrf_field() }}
<h4>Está seguro de eliminar la siguiente reserva?</h4>
            <div class="row">
                <div class="col-12">
                    <table class="table table-borderless">
  <tbody>
    <tr>
        <th scope="row">Dia</th>
        <th scope="row" >Hora Inicio</th>
        <th scope="row" >Hora Fin</th>
    </tr>
    <tr>

      <td id="dia2"></td>
      <td id="h_ini2"></td>
      <td id="h_fin2"></td>
    </tr>

  </tbody>
</table>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
      </form>
    </div>
  </div>
</div>


@section('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js'></script>

    <script>
        var dia = null;
        var user = '{{Auth::user()->id}}';
        var rol = '{{Auth::user()->rol}}';
        $(document).ready(function() {
            console.log("llega");
            var today = moment().day();
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                header:{
     
     right:'prev,next today'
    },
    timeZone: 'America/Bogota',
     locale: 'es',
                defaultView: 'agendaWeek',
                columnFormat: 'ddd DD/MMM',
                slotDuration: '00:60:00',
                height: 'auto',
                aspectRatio: 10,
                 firstDay: 1,
                dayClick: function(date, event, view) {
                    
                    var fecha_hoy = moment().format('DD/MM/YYYY');
                    
                    
var fecha_a = new Date(date);
                    console.log("date: "+date);
                     fecha_a = moment(fecha_a).format('DD/MM/YYYY');
                    
                    console.log("fecha selected: "+fecha_a);
                    console.log("fecha_hoy: "+fecha_hoy);
                  

                  isSameOrAfter = moment(fecha_a).isSameOrAfter(fecha_hoy);

                  console.log("isSameOrAfter: "+isSameOrAfter);

                 var diffDias = moment().diff(date, 'days');

                 console.log(diffDias);

                    if (diffDias <= 0) {

                        var diff = moment().diff(date, 'minutes');
                    var min = 50;

                    console.log(diff);


                    if (diff <= min){
                        
                      currentDate = date.format();
                        modal(date.format());

                       }else{

                        if (diff < 60) {
                      Lobibox.notify('error', {
                            size: 'mini',
                            msg: 'Queda muy poco tiempo para realizar el laboratorio. Intente en la siguiente hora disponible.'
                        });
                    }

                    }
                  }    



        },
                
                 minTime: '08:00:00', /* calendar start Timing */
        maxTime: '23:00:00',  /* calendar end Timing */
        allDaySlot: false,
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    buttonText: {
        today:    'Hoy',
        month:    'Mes',
        week:     'Semana',
        day:      'Día',
        list:     'Lista'
    },
    eventLimit: false,
                events : [
                        @foreach($appointments as $appointment)
                    {

                        @if ($appointment->user->id == Auth::user()->id)
                          title : 'Tú',
                          color: 'green',
                        @else
                            @if (Auth::user()->rol != 3)
                              title : '{{ $appointment->user->usuario }}',
                            @else

                            title : 'Ocupado',

                            @endif

                        @endif
                        start : '{{ $appointment->start_time }}',
                        id: '{{ $appointment->id }}',
                        @if ($appointment->finish_time)
                                end: '{{ $appointment->finish_time }}',
                        @endif
                        
                    },
                    @endforeach
                ],
                eventClick: function(calEvent, jsEvent, view) {
    jsEvent.preventDefault(); // don't let the browser navigate
    @if (Auth::user()->rol != 3)
    console.log(calEvent);            
            var elimina = '/appointments/'+ calEvent.id ;
            $('#formEliminar').attr('action',elimina  );
                $('#modalAgendaEliminar').modal();
                $('#dia2').text(moment(calEvent.start).format('DD/MM/YYYY'));
                $('#h_ini2').text(moment(calEvent.start).format('hh:mm A'));
                $('#h_fin2').text(moment(calEvent.end).format('hh:mm A'));
                //console.log(data);
    @endif
  },
                viewRender: function (currentView) {

                    var minDate = moment();
                    // Past dates
                    if (minDate > currentView.start) {
                        $(".fc-prev-button").prop('disabled', true);
                        $(".fc-prev-button").addClass('fc-state-disabled');
                    }
                    else {
                        $(".fc-prev-button").removeClass('fc-state-disabled');
                        $(".fc-prev-button").prop('disabled', false);
                    }
                },
                eventRender: function(event, element) {
                    element.css("font-size", "1em");
                    element.css("padding", "10px");
}
            })
        });

         function modal(data) {
             var selected = moment(data).format('DD/MM/YYYY hh:mm A');
             var disponible = true;

             
             var count = 0;
            @foreach($appointments as $appointment)

              var x = '{{ $appointment->start_time }}';
              var antes = moment(x).format('DD/MM/YYYY hh:mm A');
              console.log(antes);
              valid = moment(selected).isSame(antes);
              if (valid) {
                  disponible = false;
              }

              var appo = moment(x).format('DD/MM/YYYY');
              var fecha_ss = moment(data).format('DD/MM/YYYY');
              console.log("fecha_ss: "+fecha_ss);
              console.log("appo: "+appo);
              var id_p = '{{$appointment->user->id}}';
              if (moment(appo).isSame(fecha_ss) && parseInt(user) == parseInt(id_p)) {
                  
                    count++;
                    
              }



            @endforeach

            console.log("a pedido: "+count);

            if (disponible) {
                var veces = 1;
                if (count == 0) {

                dia = data;
                
                @if($lab == 1)
                    $('#l_laboratorio').text("Control e Identificación de Sistemas");
                @elseif($lab == 2)
                    $('#l_laboratorio').text("Sensórica");
                @else
                    $('#l_laboratorio').text("Manejo de Variador de Frecuencia");
                @endif

                var datetime = new Date(data);
                datetime.setHours(datetime.getHours()+1); 
                $('#modalAgenda').modal();
                $('#dia').text(moment(data).format('DD/MM/YYYY'));
                $('#h_ini').text(moment(data).format('hh:mm A'));
                $('#h_fin').text(moment(datetime).format('hh:mm A'));
                console.log(data);

                }else{
                  Lobibox.notify('error', {
                            size: 'mini',
                            msg: 'No puede agendar el laboratorio más de '+veces+' vez por día...'
                        });
                }

              }
            else{
              Lobibox.notify('error', {
                            size: 'mini',
                            msg: 'El laboratorio no está disponible.'
                        });
            }


        
        }

$("#formAgendar").submit( function(eventObj) {
      var proyecto = $('#laboratorio').val();
     

      $("<input />").attr("type", "hidden")
          .attr("name", "diaAgenda")
          .attr("value", dia)
          .appendTo("#formAgendar");

        $("<input />").attr("type", "hidden")
          .attr("name", "laboratorio")
          .attr("value", proyecto)
          .appendTo("#formAgendar");

      return true;
  });

$('#laboratorio').on('change', function() {

  window.location = "{{ route('appointments.index')}}?lab="+this.value ;
});

    </script>
@endsection
@endsection