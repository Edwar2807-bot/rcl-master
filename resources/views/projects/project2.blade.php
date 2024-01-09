@extends('layouts.admin')

<style>
    .ytplayer {
pointer-events: none;

}

table ,tr td{
    border:1px solid red
}
tbody {
    display:block;
    height:380px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;
}

th {
        font-size: 15px;
        font-weight: bold;
    }

td {
        font-size: 12px;
    }


</style>
<style type="text/css">
div.scroll_vertical {
    height: 100px;
    overflow: auto;
}
</style>
@section('content')
<div class="row">

<div class="col-lg-12" id="padre">

<div class="row">

    <div class="col-12">
        <div class="card">
    <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Laboratorio de Sensórica</h4>
                                    
                                </div>
                                
                            </div>

                            <nav>
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-teoria-tab" data-toggle="tab" href="#nav-teoria" role="tab" aria-controls="nav-teoria" aria-selected="false">Teoría</a>
<a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Manejo de Sensor</a>

</div>
</nav>
                           <div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
                        
                        <div class="text-center">
                            <button id="llenar" disabled class="btn btn-md btn-success start " onclick="modeRun(2);" type="button"><i class="fa fa-tint"></i> Llenar</button>
                            
                    
                            <button disabled id="vaciar"  class="btn btn-md btn-info start " onclick="modeRun(1);" type="button"><i class="fa fa-arrow-circle-down"></i> Vaciar</button>

                            <button  disabled id="apagar"  class="btn btn-md btn-danger " onclick="modeRun(0);" type="button"><i class="fa fa-power-off"></i> Apagar</button>
                            <br>
                            <br>
                            <p> <span id="cro">0</span> (Seg)</p>
                            
                        </div>

<div class="row">
<div class="text-center col-auto">
             @if($camera1 != null)
                @if($camera1->value != null)
                <div id="camara"></div>
                @endif
            @endif
</div>
</div>       
                            
                        </div>

                        <div class="tab-pane fade show active" id="nav-teoria" role="tabpanel" aria-labelledby="nav-teoria-tab">
                                <br>

                            <div class="row d-flex">
                            
                                        <h4>Laboratorio Remoto Sensorica</h4>
                                        <p>
                                          Esta práctica tiene como objetivo permitir que los estudiantes de la especialización instrumentación y control puedan a acceder remotamente a las prácticas de nivel, caudal, y presión para reforzar los conceptos del curso de sensorica, verificando el funcionamiento de sensores del sensor de nivel SRF06, el sensor Medidor De Flujo YF-S201 y el sensor de presión diferencial MPX10DP.
                                          
                                        </p>
                                        <br>

                                        <a href="{{ route('guiaSensorica') }}" class="btn btn-md btn-success start " ><i class="fa fa-file"></i> Descargar Guía</a>
                            
                                                                                                    
                            </div>


                        </div>

                    </div>
                        

                               
                        </div>
</div>
    </div>







  

</div>

</div>

<div class="col-lg-6 " id="migrafica" style="display: none;">

<div class="card">
    <div class="card-body">
                            
                                    <h4 class="card-title">Respuesta del sistema</h4>
                                  

                                    <table class="table table-bordered table-hover text-center ">
                                      <thead>
                                        <tr>
                                          <th scope="col">Pulsos Sensor Caudal (Hertz)</th>
                                          <th scope="col">Voltaje Sensor Presión (mV)</th>
                                          <th scope="col">Corriente Sensor Nivel(mA)</th>
                                        </tr>
                                      </thead>
                                      <tbody id="pulsos" class="myscroll">

                                      </tbody>
                                    </table>


                                    

                                    <div class="text-center">
                                    <button disabled id="download" class="btn btn-md btn-success  " onclick="descargar();" type="button"><i class="fa fa-file"></i> Download</button>
                                    </div>
                                   
                            

                        </div>
</div>
</div>


</div>   


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>


<script type="text/javascript">
var finish  = '{{$v_motor->finish_time}}';

var urlVideo ='https://viewer.millicast.com/v2?streamId='+'{{$camera1->value}}';
var frame = false;
var auxDiv = 0;
startConnect();
var toTeoria = true;
var toTeoria = true;
var timer1;
var timer2;
var arraysensor = [];
var refreshIntervalId = null;
var refreshCro = null;
var mode = 0;
var cro = 0;

$( document ).ready(function() {
console.log( "ready!" );
$('#datos1').hide();
setTimeout(mostrarVideo,5000);

//timer1 = setTimeout(cambiar,180000);


$('#nav-home-tab').click(function (e) { 

clearTimeout(timer1);
clearTimeout(timer2);
    timer1 = setTimeout(cambiar,180000);

prepareFrame();
    $('.download').show();
    $('.ymodel').show();
    $('#camaraDiv').show();
    $('.stop').hide();
    $('.velocidad').hide();
    mode = 0;
    $('#datos1').show();
    $('#migrafica').show();

if ( auxDiv == 0) {
    $("#padre").removeClass("col-lg-12");
$("#padre").addClass("col-lg-6");
}
 auxDiv = 1;

});


$('#nav-profile-tab').click(function () { 
    clearTimeout(timer1);
    clearTimeout(timer2);
    timer1 = setTimeout(cambiar,180000);
    prepareFrame();
  $('.download').hide();
  $('#camaraDiv').show();
  $('#datos1').hide();
    $('.ymodel').hide();
    $('.stop').show();
    mode = 1;
    auxControl = false;
    $('#velocidad').text(0);
    $('#migrafica').show();
    if ( auxDiv == 0) {
    $("#padre").removeClass("col-lg-12");
$("#padre").addClass("col-lg-6");
}
 auxDiv = 1;

});

$('#nav-teoria-tab').click(function () { 
    console.log("clic teoria");
  frame = false;
  $("#camara").empty();
  $('#datos1').hide();
  $('#camaraDiv').hide();
  $('#migrafica').hide();
  $("#padre").removeClass("col-lg-6");
$("#padre").addClass("col-lg-12");
 auxDiv = 0;


});




});



function cambiar() {
    if (toTeoria) {
        console.log("ir a teoria "+moment().format('hh:mm:ss'));
        $('#nav-teoria-tab').click();
    }
}





function cambiarTrue() {
    console.log("cambiando a true "+moment().format('hh:mm:ss'));
    toTeoria = true;
}


 function prepareFrame() {
    if (!frame) {
        var ifrm = document.createElement("iframe");
        ifrm.setAttribute("src", urlVideo);
        ifrm.style.width = "520px";
        ifrm.style.height = "340px";
        document.getElementById("camara").appendChild(ifrm);
    }

    frame = true;
}




var MAX_DATA_SET_LENGTH = 100;

// Called after form input is processed
function startConnect() {

      var date =   Date.now();

// Generate a random client ID
clientID = "RemoteLAB"+date;

console.log("startConnect "+clientID);

// Fetch the hostname/IP address and port ytaober from the form
host = "postman.cloudmqtt.com";
port = "30930";



client = new Paho.MQTT.Client(host, 30930,clientID);

// set callback handlers
client.onConnectionLost = onConnectionLost;
client.onMessageArrived = onMessageArrived;
var options = {
useSSL: true,
userName: "yemifrix",
password: "Y1PuRGotBrwd",
onSuccess:onConnect,
onFailure:doFail
}

// connect the client
client.connect(options);

}

// Called when the client connects
function onConnect() {
console.log("onConnect");
connect = true;
$('.start').prop('disabled', false);
// Fetch the MQTT topic from the form

// Subscribe to the requested topic
client.subscribe("RemoteLAB/#");
}

function doFail(e){
 connect = false;
$('.start').prop('disabled', true);
console.log(e);
startConnect();
}

// Called when the client loses its connection
function onConnectionLost(responseObject) {
connect = false;
$('.start').prop('disabled', true);
console.log("Connection lost");
if (responseObject.errorCode !== 0) {
    console.log(responseObject.errorMessage);
}
 startConnect();
}

// Called when a message arrives
function onMessageArrived(message) {

if (message.destinationName == "RemoteLAB/sensor") {
    datasensor = JSON.parse(message.payloadString);
    arraysensor.push(datasensor);
    console.log(datasensor);
    console.log(arraysensor);

    var pulsos = "<tr><td>"+datasensor.x1+"</td><td>"+datasensor.x2+"</td><td>"+datasensor.x3+"</td></tr>";
    $("#pulsos").append(pulsos);
    $("#pulsos").animate({ scrollTop: $('#pulsos')[0].scrollHeight}, 1000); 


    if (datasensor.y3 >= 35 &&  mode == 2) {
      clearInterval(refreshCro);
      $('.start').prop('disabled', false);
          $('#download').prop('disabled', false);
      Lobibox.notify('success', {
                size: 'mini',
                msg: 'Nivel Máximo'
            });
    }

    if (datasensor.y3 <= 0 &&  mode == 1) {
      clearInterval(refreshCro);
      $('.start').prop('disabled', false);
          $('#download').prop('disabled', false);
      Lobibox.notify('success', {
                size: 'mini',
                msg: 'Nivel Mínimo'
            });
    }



}
}

// Called when the disconnection button is pressed
function startDisconnect() {
client.disconnect();
}


// send a message
function publish (topic, message) {
console.log("topic: "+topic);
message = new Paho.MQTT.Message(message);
message.destinationName = topic;
message.qos = 1;
client.send(message);
}




function modeRun(x) {

before = moment().isSameOrAfter(finish);

toTeoria = false;



if (!before) {

    if (connect) {
      mode = x;
      console.log("enviando...: "+mode);
      if (mode != 0) {
      cro = 0;
      //refreshIntervalId = setInterval('test()',1000);
      refreshCro = setInterval('sumCro()',1000);
        arraysensor = [];
          $("#pulsos").empty();
          $('.start').prop('disabled', true);
          $('#download').prop('disabled', true);
          $('#apagar').prop('disabled', false);
      } else{
          clearInterval(refreshCro);
          $('.start').prop('disabled', false);
          $('#download').prop('disabled', false);
          $('#apagar').prop('disabled', true);

          //test
          //clearInterval(refreshIntervalId);
      }

      
       data = JSON.stringify({
                    mode: mode
                });
        
      publish("RemoteLAB/tank",data);
      

        
    }
}else{

 Lobibox.notify('success', {
                size: 'mini',
                msg: 'Se ha acabado el tiempo'
            });

 setTimeout(redirectProject,2000);

}

}

function redirectProject() {
    window.location.href = "/projects";
}





$('.enter').bind("enterKey",function(e){
conControl();
});


$('.enter').keyup(function(e){
if(e.keyCode == 13)
{
  $(this).trigger("enterKey");
}
});
 

function descargar() {


 var csv = 'Pulsos Sensor Caudal (Hertz);Voltaje Sensor Presión (mV);Corriente Sensor Nivel(mA)\n';

 arraysensor.forEach(function(row) {

var d_x1 = row.x1;
d_x1 = d_x1.toString();
d_x1 = d_x1.replace(".", ",");

var d_y1 = row.y1;
d_y1 = d_y1.toString();
d_y1 = d_y1.replace(".", ",");

var d_x2 = row.x2;
d_x2 = d_x2.toString();
d_x2 = d_x2.replace(".", ",");

var d_y2 = row.y2;
d_y2 = d_y2.toString();
d_y2 = d_y2.replace(".", ",");


var d_x3 = row.x3;
d_x3 = d_x3.toString();
d_x3 = d_x3.replace(".", ",");

var d_y3 = row.y3;
d_y3 = d_y3.toString();
d_y3 = d_y3.replace(".", ",");


        csv += d_x1+";"+d_x2+";"+d_x3;
        csv += "\n";

});

var hiddenElement = document.createElement('a');
hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
hiddenElement.target = '_blank';
hiddenElement.download = 'data.csv';
hiddenElement.click();
}


function mostrarVideo( ) {
$("#ytplayer").css("display","block");

}


function test() {

    datasensor = {
                    x1: 1,
                    y1: 1,
                    x2: 2,
                    y2: 2,
                    x3: 3,
                    y3: 3,
                };

    arraysensor.push(datasensor);
    console.log(datasensor);
    console.log(arraysensor);

    var pulsos = "<tr><td>"+datasensor.x1+"</td><td>"+datasensor.x2+"</td><td>"+datasensor.x3+"</td></tr>";
    $("#pulsos").append(pulsos);
    $("#pulsos").animate({ scrollTop: $('#pulsos')[0].scrollHeight}, 1000); 
}


function sumCro() {
  cro++;
  $("#cro").text(cro);
}



</script>

@endsection
@endsection
