@extends('layouts.admin')
 <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
 <style>
        #camera1{
            width: 320px !important;
            height: 240px !important;
        }

        .ytplayer {
pointer-events: none;

}

    </style>
@section('content')
<div class="row">
                  
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Input Configuration</h4>
                                <div class="feed-widget">
                                    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tab 1</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tab 2</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      
 <div class="row">
                                 

                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>T(ms) Sampling</b> </label>
                                            <input class="sampling" type="text" value="20" name="sampling" id="sampling">
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>T(s) Capture </b> </label>
                                            <input class="capture" type="text" value="3" name="capture" id="capture">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>PWM </b> </label>
                                            <input class="pwm" type="text" value="60" name="pwm" id="pwm">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <button disabled id="start" class="btn btn-md btn-primary  " onclick="runMotor();" type="button"><i class="fa fa-play"></i> Run</button>
                                    </div>

                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                       <a class="btn btn-md btn-success  " href="#" id="idDownload" ><i class="fa fa-file-excel-o"></i> Download</a>
                                    </div>
                                                                                                        
                                </div>
                            

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">.233..</div>

</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div class="row">
                  
<div class="col-8">
    <div class="card">
        <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Graph</h4>
                                        <h5 class="card-subtitle">subtitle</h5>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-12">
                                        <canvas id="chart" width="600" height="400"></canvas>
                                    </div>
                                    <!-- column -->
                                </div>
                            </div>
    </div>
</div>
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Camera</h4>
            <div class="text-center">
                <!-- <img id="camera1" src=""> -->
                 <iframe width="320" height="240" class="ytplayer" id="ytplayer" style="display: none;"  src="https://www.youtube.com/embed/8XL8Qk4qzyA?modestbranding=1&;showinfo=0&;autohide=1&;rel=0&;controls=0&;autoplay=1&;&mute=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>  
            </div>
        </div>
    </div>
</div>
</div>




@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>
<script src="{{ asset('js/Chart.min.js')}}"></script>


<script type="text/javascript">

  startConnect();

$( document ).ready(function() {
    console.log( "ready!" );
    setTimeout(mostrarVideo,5000);

  
});

var mainGraph = null;
var sampling = 0;
var pwm = 0 ;
var capture = 0 ;
var dataGraph =  null; // new Array
var labels  = []; 
var cont = 0;
var connect = false;

// Called after form input is processed
function startConnect() {
    console.log("startConnect");
    // Generate a random client ID
    clientID = "RemoteLAB";

    // Fetch the hostname/IP address and port number from the form
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
    console.log("onMessageArrived: " + message.payloadString);
    console.log("onMessageArrived: " + message.destinationName);
    if (message.destinationName == "RemoteLAB/speed") {
        responseMotor(message.payloadString);
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

    if (connect) {
    //dataGraph = null;
    pwm =  document.getElementById('pwm').value;
    capture =  document.getElementById('capture').value;
    sampling =  document.getElementById('sampling').value;
    maxpwm = parseInt(pwm) + parseInt(pwm) * 0.5;
    //getlabels();
    data = JSON.stringify({
                        sampling: sampling,
                        pwm: pwm,
                        capture: (capture * 1000)
                    });

    
     
    

   //config graph

  
     

mainGraph.options.scales.xAxes[0].ticks.max = parseInt(capture);
mainGraph.options.scales.xAxes[0].ticks.stepSize = parseInt(sampling)/100;
mainGraph.update();
            cont++;
            publish("RemoteLAB/ident",data);
}
}


   var lineChartData = {
            datasets: [{
                label: 'Motor',
                borderColor: 'red',
                pointBackgroundColor: 'red',
                fill: false,pointRadius: 0,
  pointHitRadius: 0,
                
            }, {
                label: 'System',
                borderColor: 'blue',
                pointBackgroundColor: 'blue',
                fill: false,pointRadius: 0,
  pointHitRadius: 0,
               
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
}
};
       
var chartEl = document.getElementById('chart');

 mainGraph = new Chart(chartEl, {
                type: 'line',
                data: lineChartData,
                options: options,
                 
            });





function responseMotor(data) {
    datamotor = JSON.parse(data);
    console.log(mainGraph);
    console.log(datamotor);
    //update
    mainGraph.data.datasets[0].data[cont] = datamotor.y;
    mainGraph.data.datasets[1].data[cont] = pwm;
    mainGraph.update();
    
    if (parseFloat(datamotor.t) >= parseFloat(capture) ) {

          mainGraph = null;
    cont = 0;
    labels  = null; 
    dataGraph =  null;

           Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Simulation successfully completed.'
                });
           
      }  
    cont++;
}

//aqui
function add(){
mainGraph.data.datasets[0].data[1] = 60;
mainGraph.data.datasets[1].data[1] = 20;
mainGraph.update();
}

function getlabels() {

i = 0;
do {
    labels.push(i);
  i = i + parseInt(sampling);
 
        
} while (i != (capture * 1000));

}

/*

var socket = io.connect('https://live-rcl.herokuapp.com', {secure: true});
        var video;
        var id;
        
socket.on('connect', function(){ console.log('connected to socket'); });

      socket.on('error', function(e){ console.log('error' + e); });

        socket.on('updateImage', function(data){
            console.log("llega algo");
            $('#camera1').attr('src',data.captura)
        });

        

*/

function mostrarVideo( ) {
   $("#ytplayer").css("display","block");

}




</script>

@endsection
@endsection
