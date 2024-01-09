@extends('layouts.admin')
<link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
<style>
    .ytplayer {
pointer-events: none;

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
                                    <h4 class="card-title">Control</h4>
                                    
                                </div>
                                
                            </div>

                            <nav>
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-teoria-tab" data-toggle="tab" href="#nav-teoria" role="tab" aria-controls="nav-teoria" aria-selected="false">Teoría</a>
{{-- <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Identificación</a> --}}
<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Control PID</a>
</div>
</nav>
                           <div class="tab-content" id="nav-tabContent">
{{-- <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
                                    <div class="row d-flex justify-content-center">
                             

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="touchspin-inner" style="width: 120px;">
                                        <label><b>T_muestreo (ms)</b> </label>
                                        <input class="sampling" type="text" value="20" name="sampling" id="sampling">
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="touchspin-inner" style="width: 120px;">
                                        <label><b>Duración (s) </b> </label>
                                        <input class="capture" type="text" value="3" name="capture" id="capture">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="touchspin-inner" style="width: 120px;">
                                        <label><b>Voltaje (V) </b> </label>
                                        <input class="pwm" type="text" value="3" name="pwm" id="pwm">
                                    </div>
                                </div>
                                                                                                    
                            </div>

                            
                        </div> --}}
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <br>

                            <div class="row d-flex justify-content-center">
                             

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                
                                        <label><b>sp</b> </label>
                                        <input class="sp enter" type="number" value="100" name="sp" style="width: 60px;" id="sp">
                                    
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                
                                        <label><b>kp</b> </label>
                                        <input class="kp enter" type="number" value="1" name="kp" style="width: 60px;" id="kp">
                                    
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                
                                        <label><b>ki</b> </label>
                                        <input class="ki enter" type="number" value="0" name="ki" style="width: 60px;" id="ki">
                                    
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                
                                        <label><b>kd</b> </label>
                                        <input class="kd enter" type="number" value="0" name="kd" style="width: 60px;" id="kd">
                                    
                                </div>



                                                                                                    
                            </div>


                        </div>

                        <div class="tab-pane fade show active" id="nav-teoria" role="tabpanel" aria-labelledby="nav-teoria-tab">
                                <br>

                            <div class="row d-flex">
                             

                                        <h4>PID</h4>
                                        <br>
                                        <p>Los controladores son elementos que se le agregan al sistema original para mejorar sus características de funcionamiento, con el objetivo de satisfacer las especificaciones de diseño tanto en régimen transitorio como en estado estable.</p>

                                        <p>El control proporcional-integral-derivado (PID) es el algoritmo de control más utilizado y con gran aceptación en el control industrial. La popularidad de los controladores PID se puede atribuir en parte a su rendimiento robusto en una amplia gama de condiciones de operación y en parte a su simplicidad funcional, que permite a los ingenieros operarlos de una manera simple y directa.</p>

                                        <br>
                                    
                                      
        <div class="col-12">
            <div class="text-center">
            <img class="mx-auto d-block img-fluid" src="{{ asset('img/teoria2.JPG') }}">  
        </div>
        </div>
 
 <br>

                                        <p>La idea básica detrás de un controlador PID es leer un sensor, luego calcular la salida deseada del actuador calculando respuestas proporcionales, integrales y derivadas y sumando esos tres componentes para calcular la salida. Si se trata de un controlador digital, todos éstos cálculos se deben realizar dentro de un periodo de muestreo Ts.</p>

                                        <p>Para hallar los parámetros del controlador PID (Kp Ki Kd) se debe conocer el modelo del sistema, ya sea mediante un proceso de modelado matemático o un proceso de identificación de sistemas. Una vez se tiene el modelo, los parámetros se pueden calcular usando un software como Sisotool de Matlab o aplicando alguna técnica de sintonización.</p>

                                        <p>Para el caso del motor DC, su modelo se puede aproximar mediante el diagrama de bloques a continuación. Allí se relacionan las partes eléctrica y mecánica que permiten que el motor convierta energía eléctrica en energía cinética de rotación.</p>

                                                   <br>
                                                                   
                                      
        <div class="col-12">
            <div class="text-center">
            <img class="mx-auto d-block img-fluid" src="{{ asset('img/teoria.jpg') }}">  
        </div>
        </div>
        <br>

        <p>La tabla siguiente relaciona cada uno de los parámetros del motor DC que tiene equipado el laboratorio remoto, con el fin de que el estudiante realice su modelado y lo compare con los datos que encontrará en la práctica.</p>
        <br>
                                        <table  class="table text-center">
                                        <tr>
                                        <th>L</th>
                                        <th>R</th>
                                        <th>Kt</th>
                                        <th>Ke</th>
                                        <th>J</th>
                                        <th>B</th>
                                      </tr>
                                      <tr>
                                        <td>70e-3 H</td>
                                        <td>2.7 Ω</td>
                                        <td>16.4e-3  N.m/A</td>
                                        <td>16.4e-3  V/rad/s</td>
                                        <td>0.44e-3  Kg.m^2</td>
                                        <td>1.9e-3   N.m.s/rad</td>
                                      </tr>
                                      <hr>
                                       <tr>
                                        <th>Tau</th>
                                        <th>wn</th>
                                        <th>Vn</th>
                                        <th>Tn</th>
                                        <th>In</th>
                                      </tr>
                                      <tr>
                                        <td>0.23 s</td>
                                        <td>200 RPM</td>
                                        <td>6 V</td>
                                        <td>34.5e-3  N.m</td>
                                        <td>0.48 A</td>
                                      </tr>
                                         
                                        </table>


                                                                                                    
                            </div>


                        </div>

                    </div>
                        

                               
                        </div>
</div>
    </div>







    <div class="col-12" id="camaraDiv" style="display: none;">
        <div class="card ">
    <div class="card-body">
        <h4 class="card-title">Camara</h4>
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-center">


             @if($camera1 != null)
                @if($camera1->value != null)
                <div id="camara"></div>
                @endif
            @endif


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
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Respuesta del sistema</h4>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <canvas id="chart" width="600" height="400"></canvas>
                                </div>
                                
                            </div>
<hr>
                            <div class="row d-flex justify-content-center">

                                 <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                    <button disabled id="start" class="btn btn-md btn-primary  " onclick="runMotor();" type="button"><i class="fa fa-play"></i> Run</button>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 ymodel mr-2">
                                    <button disabled id="ymodel" class="btn btn-md btn-primary  " onclick="graphModel();" type="button"> Find G(s)</button>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 download">
                                   <button disabled id="download" class="btn btn-md btn-success  " onclick="descargar();" type="button"><i class="fa fa-file"></i> Download</button>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 velocidad" style="display: none;">
                                        <p > <span id="velocidad"></span> RPM </p>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 stop" style="display: none;">
                                   <button disabled id="stop" class="btn btn-md btn-success  "  onclick="stopMotor();" type="button"><i class="fa fa-stop"></i> Stop</button>
                                </div>

                            </div>

                            <div id="datos1" style="display: none; padding-top: 2px;">
                                <br>
                            <div class="row d-flex justify-content-center " style="display: none;">

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <p style="display: none;"><b>A</b> = <span id="a"></span> </p>
                                </div>

                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <p style="display: none;"><b>K</b> = <span id="k"></span> </p>
                                </div>

                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <p style="display: none;"><b>Tao</b> = <span id="oTao"></span> </p>
                                </div>

                            </div>
                            </div>

                        </div>
</div>
</div>


</div>   


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>
<script src="{{ asset('js/Chart.min.js')}}"></script>


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
        ifrm.style.width = "320px";
        ifrm.style.height = "240px";
        document.getElementById("camara").appendChild(ifrm);
    }

    frame = true;
}

var mainGraph = null;
var sampling = 0;
var pwm = 0 ;
var capture = 0 ;
var labels  = []; 
var cont = 0;
var connect = false;
var a = 0;
var ytao = 0;
var cercano = 0;
var index = 0;
var oTao = null;
var ymodel = false;
var mode = 0;
var auxControl = false;
var ant = 0;
var voltaje = 0;
var runnig = false;


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
$('#start').prop('disabled', false);
// Fetch the MQTT topic from the form

// Subscribe to the requested topic
client.subscribe("RemoteLAB/#");
}

function doFail(e){
 connect = false;
$('#start').prop('disabled', true);
console.log(e);
startConnect();
}

// Called when the client loses its connection
function onConnectionLost(responseObject) {
connect = false;
$('#start').prop('disabled', true);
console.log("Connection lost");
if (responseObject.errorCode !== 0) {
    console.log(responseObject.errorMessage);
}
 startConnect();
}

// Called when a message arrives
function onMessageArrived(message) {

if (message.destinationName == "RemoteLAB/speed_i") {
    responseMotor(message.payloadString);
}else if (message.destinationName == "RemoteLAB/speed_c"){
    responseMotorControl(message.payloadString);
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


function runMotor() {

before = moment().isSameOrAfter(finish);

toTeoria = false;



if (!before) {

    if (connect) {


        if (mode == 0) {
            sinControl();
        }else{ 
            conControl();
        }
        
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


function sinControl() {
    console.log("runnig...");
 $('#start').prop('disabled', true);
 $('#download').prop('disabled', true);
 $('#ymodel').prop('disabled', true);
 runnig = false;
 ymodel = false;
    mainGraph.data.datasets[0].data = [];
    mainGraph.data.datasets[2].data = [];
    mainGraph.data.datasets[1].data = [];
    mainGraph.data.datasets[1].label = "Modelo";
    mainGraph.data.datasets[2].label = "Voltaje";
    mainGraph.options.scales.xAxes[0].ticks.min = 0;
    
    mainGraph.update();
cont = 0;
labels  = []; 
voltaje =  document.getElementById('pwm').value;
voltaje =  document.getElementById('pwm').value;
pwm =  document.getElementById('pwm').value;

pwm = (parseFloat(pwm)*8.5822) + 51.282;

capture =  document.getElementById('capture').value;
sampling =  document.getElementById('sampling').value;
maxpwm = parseInt(pwm) + parseInt(pwm) * 0.5;
a = (parseInt(pwm)*160)/100;


data = JSON.stringify({
                    sampling: sampling,
                    pwm: pwm,
                    capture: (capture * 1000)
                });

mainGraph.options.scales.xAxes[0].ticks.max = parseInt(capture);
mainGraph.update();

cont++;
        
publish("RemoteLAB/ident",data);

}

function conControl(argument) {
    
    $('#stop').prop('disabled', false);
    $('.velocidad').show();
    console.log("runnig...");
    if (!runnig) {
        mainGraph.data.datasets[0].data = [];
        mainGraph.data.datasets[2].data = [];
        mainGraph.data.datasets[1].data = [];
        mainGraph.data.datasets[1].label = "Referencia";
        mainGraph.data.datasets[2].label = "Accion de Control";
        mainGraph.options.scales.xAxes[0].ticks = {};
        mainGraph.options.scales.xAxes[0].ticks.max = 5;
        mainGraph.options.scales.xAxes[0].ticks.maxTicksLimit = 10;
        mainGraph.options.scales.xAxes[0].ticks.callback = getXAxisLabel;
        
        mainGraph.update();
    }
    

    kd =  document.getElementById('kd').value;
    ki =  document.getElementById('ki').value;
    kp =  document.getElementById('kp').value;
    sp =  document.getElementById('sp').value;

    data = JSON.stringify({
                    sampling: 50,
                    capture: 10000,
                    sp: sp,
                    kd: kd,
                    ki: ki,
                    kp: kp,
                });
    publish("RemoteLAB/pid",data);
}

function getXAxisLabel(value) {
        try {
            var xMin = mainGraph.options.scales.xAxes[0].ticks.min;
        } catch(e) {
            var xMin = undefined;
        }
        if (xMin === value) {
            return '';
        } else {
            return value;
        }
    }




var lineChartData = {
        //labels: labels,
        datasets: [{
     label: "Velocidad",
     borderColor: 'red',
     yAxisID: 'A',
            pointBackgroundColor: 'red',
           fill: false,
     tension: 0,
     showLine: true,
     pointRadius: 0,
pointHitRadius: 0,
borderWidth: 2,
  },{
     label: "Modelo",
     yAxisID: 'B',
     borderColor: '#e5be01',
            pointBackgroundColor: '#e5be01',
           fill: false,
     tension: 0,
     showLine: true,
     pointRadius: 0,
pointHitRadius: 0,
borderWidth: 2,
  },{
     label: "Voltaje",
     borderColor: 'blue',
     yAxisID: 'C',
            pointBackgroundColor: 'blue',
           fill: false,
     tension: 0,
     showLine: true,
     pointRadius: 0,
pointHitRadius: 0,
borderWidth: 2,
  }]
    };

var options = {
 animation: false,
responsive: true,
scales: {
  xAxes: [{
  type: 'linear',
  ticks: {
            max: 3,
            min: 0,
            stepSize: 0.2,
            beginAtZero: true,

            }
}],
yAxes: [{
    id: 'A',
  type: 'linear',
  position: 'left',
  ticks: {
            max: 210,
            min: 0,
            stepSize: 10,
            beginAtZero: true,

            }
},{
        id: 'C',
        type: 'linear',
        position: 'right',
        ticks: {
          max: 7,
          min: 0
        }
      },{
        id: 'B',
        type: 'linear',
        display: false,
        position: 'right',
        ticks: {
           max: 210,
            min: 0,
            stepSize: 10,
            beginAtZero: true,
        }
      }
]
}
};

        var chartEl = document.getElementById('chart');
        mainGraph = new Chart(chartEl, {
            type: 'scatter',
            data: lineChartData,
            options: options,
             
        });

function responseMotor(data) {
datamotor = JSON.parse(data);
console.log(datamotor);


//update
$('#a').text(a);

k = (parseFloat(datamotor.y)/a).toFixed(3);

$('#k').text(k);


ytao = (0.632*parseFloat(datamotor.y)).toFixed(3);


mainGraph.data.datasets[0].data.push( {x: datamotor.t, y: datamotor.y});
mainGraph.data.datasets[2].data.push( {x: datamotor.t, y: voltaje});

mainGraph.update();


if (parseFloat(datamotor.t) >= parseFloat(capture) ) {
$('#start').prop('disabled', false);
$('#download').prop('disabled', false);
$('#ymodel').prop('disabled', false);
oTao = masCercano();
runnig = false;
clearTimeout(timer1);
clearTimeout(timer2);
timer2 = setTimeout(cambiarTrue,180000);
timer1 = setTimeout(cambiar,240000);
$('#oTao').text(oTao.x);
       Lobibox.notify('success', {
                size: 'mini',
                msg: 'Simulation successfully completed.'
            });
       
  }  
cont++;
}

var cControl = 1;

function responseMotorControl(data) {
datamotor = JSON.parse(data);
console.log(datamotor);


runnig = datamotor.run;

if(runnig){

if (parseFloat(datamotor.y) > 200) {
    datamotor.y = ant;
}

ant = datamotor.y;


  var motorDataLength = mainGraph.data.datasets[0].data.length;

  if (motorDataLength > MAX_DATA_SET_LENGTH) {
        mainGraph.data.datasets[0].data.shift();
        mainGraph.data.datasets[2].data.shift();
        mainGraph.data.datasets[1].data.shift();
        //mainGraph.data.labels.shift();
        min = mainGraph.data.datasets[0].data[0].x;
        mainGraph.options.scales.xAxes[0].ticks.min = min;
        mainGraph.options.scales.xAxes[0].ticks.max = datamotor.t;
  }

var v = parseFloat(datamotor.y).toFixed(0);
  if (cControl == 15) {
    $('#velocidad').text(v);
    cControl =0;
  }
cControl++;



mainGraph.data.datasets[0].data.push( {x: datamotor.t, y: datamotor.y});
mainGraph.data.datasets[1].data.push( {x: datamotor.t, y: datamotor.sp});
mainGraph.data.datasets[2].data.push( {x: datamotor.t, y: datamotor.m});
mainGraph.update();

}else {
    clearTimeout(timer1);
    clearTimeout(timer2);
    timer2 = setTimeout(cambiarTrue,180000);
    timer1 = setTimeout(cambiar,240000);
    Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Simulation successfully completed.'
                });
    }

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

 var csv = 'x;y\n';
mainGraph.data.datasets[0].data.forEach(function(row) {

    var d_x = row.x;
   d_x = d_x.toString();
   d_x = d_x.replace(".", ",");

     var d_y = row.y;
   d_y = d_y.toString();
   d_y = d_y.replace(".", ",");

        csv += d_x+";"+d_y;
        csv += "\n";

});

var hiddenElement = document.createElement('a');
hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
hiddenElement.target = '_blank';
hiddenElement.download = 'data.csv';
hiddenElement.click();
}



function masCercano() {
        var obj = new Object();
        var diferencia = Number.MAX_SAFE_INTEGER;
        var cercano_x = 0;
        mainGraph.data.datasets[0].data.forEach(function(row) {
            
            value_y = parseFloat(row.y).toFixed(3);        

            if (value_y == ytao) {
                obj.x = row.x;
                obj.y = value_y;
            return obj;
            } else {
                if(Math.abs(value_y-ytao)<diferencia){
                    cercano = value_y;
                    cercano_x = row.x;
                    diferencia = Math.abs(value_y-ytao);
                }
            }

        });

    obj.x = cercano_x;
    obj.y = cercano;
    return obj;
        

    }

function mostrarVideo( ) {
$("#ytplayer").css("display","block");

}

function graphModel() {
if (!ymodel) {

    
mainGraph.data.datasets[0].data.forEach(function(row) {
    console.log(row);
        var x = parseFloat(row.x);
        var tao = parseFloat(oTao.x);
        ym = (a*k) -  (a*k*Math.exp(-x/tao));
        console.log("tao:"+tao);
        console.log("x_new:"+x);
        console.log("ym:"+ym);
        mainGraph.data.datasets[1].data.push( {x: row.x, y: ym});
        mainGraph.update();
 });   
 
}

ymodel = true;

}

function stopMotor() {
    console.log("stopMotor..");
    $('#start').prop('disabled', false);
    $('#stop').prop('disabled', true);
    data = JSON.stringify({
                    sampling: 0,
                    capture: 0,
                    sp: 0,
                    kd: 0,
                    ki: 0,
                    kp: 0,
                });
    auxControl = false;
    publish("RemoteLAB/pid",data);
}



</script>

@endsection
@endsection
