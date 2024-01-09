@extends('layouts.admin')
@section('content')
<br>
<div class="container-fluid">


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b>Input Configuration</b></span>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>

                            <div class="row">
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <p class="text-center" style="margin-top: 5px;"> <b>T(s) Sampling </b> </p>
                                        <p class="text-center">0.1</p>
                                    </div>  


                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>T(s) Capture </b> </label>
                                            <input class="capture" type="text" value="10" name="capture" id="capture">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>RPM1 </b> </label>
                                            <input class="rpm" type="text" value="50" name="rpm" id="rpm1">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>RPM2 </b> </label>
                                            <input class="rpm" type="text" value="50" name="rpm" id="rpm2">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                        <div class="touchspin-inner" style="width: 120px;">
                                            <label><b>RPM 3</b> </label>
                                            <input class="rpm" type="text" value="50" name="rpm" id="rpm3">
                                        </div>
                                    </div>


                                    
                                </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                       <button class="btn btn-lg btn-primary  " onclick="connect();" type="button">Send</button>
                                       <button class="btn btn-lg btn-success  " type="submit">Download data</button>
                                    </div>
                            </div>
                            
                           
                        </div>
                    </div>
</div>

	
<br>
<div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b>Tittle</b></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="actions graph-rp graph-rp-dl">
                                            <p id='crono'>00:00:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline cus-product-sl-rp">
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #006DF0;"></i>System</h5>
                                </li>
                                <li>
                                    <h5><i class="fa fa-circle" style="color: #65b12d;"></i>Motor</h5>
                                </li>
                            </ul>
                            <div id="graphProject1" style="height: 340px;"></div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sales-chart">
                            <div class="portlet-title">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="caption pro-sl-hd">
                                            <span class="caption-subject"><b>Camera</b></span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
</div>


</div>



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sockjs-client@1/dist/sockjs.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
<script  src="{{ asset('js/morrisjs/raphael-min.js')}}"></script>
<script  src="{{ asset('js/morrisjs/morris.js')}}"></script>
<script type="text/javascript">
    var stompClient = null;
    var inicio=0;
    var timeout=0;
    var capture = 0;
    var interval ;
    var idData = 0 ;
    var currentx = 0 ;
    var rpm1 = 0 ;
    var rpm2 = 0 ;
    var rpm3 = 0 ;

$( document ).ready(function() {
    console.log( "ready!" );
});

function connect() {
    var socket = new SockJS('http://127.0.0.1:8080/rcl');
    stompClient = Stomp.over(socket);
    stompClient.connect({}, function (frame) {
        console.log('Connected: ' + frame);
        senddata();
        stompClient.subscribe('/topic/project1', function (rta) {
           console.log("rta:");
           console.log(rta.body);
        });
    });
}


function disconnect() {
    if (stompClient !== null) {
        stompClient.disconnect();
    }
    
    console.log("Disconnected");
}
    function funcionando()
    {
        // obteneos la fecha actual
        var actual = new Date().getTime();
 
        // obtenemos la diferencia entre la fecha actual y la de inicio
        var diff=new Date(actual-inicio);
 
        // mostramos la diferencia entre la fecha actual y la inicial
        var result=LeadingZero(diff.getUTCHours())+":"+LeadingZero(diff.getUTCMinutes())+":"+LeadingZero(diff.getUTCSeconds());
        document.getElementById('crono').innerHTML = result;
        // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
        if (capture != diff.getUTCSeconds()) {
        timeout=setTimeout("funcionando()",500);
        }else{
            inicio=0;
            timeout=0;
           capture = 0;
            
        }
        
    }

    function LeadingZero(Time) {
        return (Time < 10) ? "0" + Time : + Time;
    }






function renderGraph() {
   
          $.getJSON('/api/project1',
            function(results) {
            console.log('results.graphData');   
            console.log(results.graphData);
            var maxPpg = getMax(results.graphData, "period");
            console.log('maxPpg: '+maxPpg.period);
            currentx = maxPpg.period ;
            $("#graphProject1").html("");    
            mainGraph =  Morris.Area({
                element: 'graphProject1',
                data: results.graphData,
                xkey: 'period',
                ykeys: ['System', 'Motor'],
                labels: ['System', 'Motor'],
                pointSize: 2,
                fillOpacity: 0,
                pointStrokeColors:['#006DF0', '#65b12d'],
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                lineWidth: 1,
                hideHover: 'auto',
                lineColors: ['#006DF0', '#65b12d'],
                resize: true,
                gridStrokeWidth  : 0.4,
                parseTime: false ,
                smooth: false ,
                xLabelFormat: function(x) {
                            return x.src.period+' '; 
                            },
                
            });  
         
              // Set up an interval on which the graph data is to be updated
              // Note the passing of the mainGraph parameter
              
            });

      if (currentx >= capture * 1000) {
           clearInterval(interval); // stop the interval
           Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Simulation successfully completed.'
                });
           disconnect();
      }    
    
}


function senddata() {
   console.log("hace senddata");
    rpm1 =  document.getElementById('rpm1').value;
    rpm2 =  document.getElementById('rpm2').value;
    rpm3 =  document.getElementById('rpm3').value;
    time =  document.getElementById('capture').value;

            $.ajax({
                url: "http://localhost:8080/project1/start",
                type: "post",
                data: JSON.stringify({
                        rpm1: rpm1,
                        rpm2: rpm2,
                        rpm3: rpm3,
                        capture: time
                    }),
                cache: false,
                dataType: 'json',
                contentType: "application/json",
               
            success: function(data) {
                    console.log(data);
                    idData = data.id;
                    console.log("idData: "+idData);
                    if (idData != 0) {


        //interval = setInterval(function() { renderGraph(); }, 10);
        inicio=0;
        timeout=0;
        capture =  document.getElementById('capture').value;
        console.log("capture: "+capture);
         // empezar el cronometro
 
           
 
            // Obtenemos el valor actual
            inicio=vuelta=new Date().getTime();
 
            // iniciamos el proceso
            funcionando();
        }   
            },
            error: function(data){             
                console.log("error");
                idData = 0;
            }
            });
}

function getMax(arr, prop) {
    var max;
    for (var i=0 ; i<arr.length ; i++) {
        if (max == null || parseInt(arr[i][prop]) > parseInt(max[prop]))
            max = arr[i];
    }
    return max;
}



  

</script>
<!-- morrisjs JS
		============================================ -->
   
    <!-- morrisjs JS
		============================================ -->

@endsection
@endsection
