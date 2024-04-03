@extends('layouts.admin')
<link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
<style>
        .equation {
            font-size: 20px;
            text-align: center;
            line-height: 1.5; /* Ajusta el espacio entre líneas */
        }
        .numerator {
            border-bottom: 1px solid black;
            display: inline; /* Hace que el numerador se muestre en línea */
        }
        .denominator {
            text-align: center;
            display: block; /* Hace que el denominador se muestre en una nueva línea */
        }
    .ytplayer {
        pointer-events: none;
    }

    /* Estilos personalizados para el slider */
    input[type=range] {
        -webkit-appearance: none;
        width: 200px;
        height: 10px;
        margin: 10px 0;
    }

    input[type=range]:focus {
        outline: none;
    }

    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 10px;
        cursor: pointer;
        background: none;
        /* Sin relleno */
        border: 1px solid #ccc;
        /* Bordes */
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: orange;
        cursor: pointer;
        border-radius: 50%;
        margin-top: -5px;
        /* Ajuste para centrar verticalmente */
    }

    input[type=range]:focus::-webkit-slider-runnable-track {
        background: none;
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
                                    <a class="nav-item nav-link active" id="nav-teoria-tab" data-toggle="tab"
                                        href="#nav-teoria" role="tab" aria-controls="nav-teoria"
                                        aria-selected="false">Teoría</a>
                                    {{-- <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Identificación</a> --}}
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                        role="tab" aria-controls="nav-profile" aria-selected="false">Control PID</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <br>
                                    <div class="row d-flex justify-content-center">


                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="touchspin-inner" style="width: 120px;">
                                                <label><b>T_muestreo (ms)</b> </label>
                                                <input class="sampling" type="text" value="20" name="sampling"
                                                    id="sampling">
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="touchspin-inner" style="width: 120px;">
                                                <label><b>Duración (s) </b> </label>
                                                <input class="capture" type="text" value="3" name="capture"
                                                    id="capture">
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="touchspin-inner" style="width: 120px;">
                                                <label><b>Voltaje (V) </b> </label>
                                                <input class="pwm" type="text" value="3" name="pwm"
                                                    id="pwm">
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <br>

                                    <div class="row d-flex justify-content-center">

                                        {{--
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                
                                        <label><b>sp</b> </label>
                                        <input class="sp enter" type="number" value="100" name="sp" style="width: 60px;" id="sp">
                                    
                                </div>
                            --}}
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <label><b>sp</b></label>
                                            <input class="sp enter" type="range" value="20" name="sp"
                                                style="width: 70px;" id="sp" min="4" max="35.5"
                                                step="0.5" oninput="actualizarValorSP(this)">
                                            <span id="valorSeleccionado">20</span>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12">

                                            <label><b>kp</b> </label>
                                            <input class="kp enter" type="number" value="12" name="kp"
                                                style="width: 60px;" id="kp">

                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12">

                                            <label><b>ki</b> </label>
                                            <input class="ki enter" type="number" value="1.2" name="ki"
                                                style="width: 60px;" id="ki">

                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12">

                                            <label><b>kd</b> </label>
                                            <input class="kd enter" type="number" value="4000" name="kd"
                                                style="width: 60px;" id="kd">

                                        </div>




                                    </div>


                                </div>

                                <div class="tab-pane fade show active" id="nav-teoria" role="tabpanel"
                                    aria-labelledby="nav-teoria-tab">
                                    <br>

                                    <div class="row d-flex">


                                        <h4>PID</h4>

                                        <br>

                                        <p>Los controladores son elementos que se le agregan al sistema original para
                                            mejorar sus características de funcionamiento, con el objetivo de satisfacer las
                                            especificaciones de diseño tanto en régimen transitorio como en estado estable.
                                        </p>

                                        <p>El control proporcional-integral-derivado (PID) es el algoritmo de control más
                                            utilizado y con gran aceptación en el control industrial. La popularidad de los
                                            controladores PID se puede atribuir en parte a su rendimiento robusto en una
                                            amplia gama de condiciones de operación y en parte a su simplicidad funcional,
                                            que permite a los ingenieros operarlos de una manera simple y directa.</p>

                                        <br>


                                        <div class="col-12">
                                            <div class="text-center">
                                                <img class="mx-auto d-block img-fluid"
                                                    src="{{ asset('img/teoria2.png') }}" width="600" height="200">
                                            </div>
                                        </div>

                                        <br>

                                        <p>La idea básica detrás de un controlador PID es leer un sensor, luego calcular la
                                            salida deseada del actuador calculando respuestas proporcionales, integrales y
                                            derivadas y sumando esos tres componentes para calcular la salida. Si se trata
                                            de un controlador digital, todos éstos cálculos se deben realizar dentro de un
                                            periodo de muestreo Ts.</p>

                                        <p>Para hallar los parámetros del controlador PID (Kp Ki Kd) se debe conocer el
                                            modelo del sistema, ya sea mediante un proceso de modelado matemático o un
                                            proceso de identificación de sistemas. Una vez se tiene el modelo, los
                                            parámetros se pueden calcular usando un software como Sisotool de Matlab o
                                            aplicando alguna técnica de sintonización.</p>

                                        <p>Para el caso del Ball and Beam, su modelo se relaciona con el control de posición
                                            del motor y el control de posición de la pelota en la viga, para este sistema
                                            empleamos un servomotor que nos entrega el control de angulo con un rango entre
                                            0° y 140° y un sensor de distancia que permite calcular la posición de la
                                            pelota.</p>

                                        <br>

                                        <br>

                                        <div class="col-12">
                                            <div class="text-center">
                                                <img class="mx-auto d-block img-fluid"
                                                    src="{{ asset('img/teoria.jpg') }}"width="600" height="200">                                                    
                                            </div>
                                        </div>  
                                        <br>  
                                                                                

                                        <p>Acontinuación se relacionan las partes eléctrica y mecánica que permiten
                                            funcionar el sistema.</p>

                                        <br>

                                        <div class="col-12">
                                            <div class="text-center">
                                                <img class="mx-auto d-block img-fluid"
                                                    src="{{ asset('img/sistema.jpeg') }}"width="500" height="200">
                                            </div>
                                        </div>
                                        <br>

                                        <p>La siguiente ecuación integra el resultado de la función de transferencia del sistema, con la cual puedes determinar los parámetros 
                                            del PID que mejoran la respuesta de sistema Ball and Beam.
                                        </p>
                                        <br>

                                        <div class="col-12">
                                            <div class="text-center">
                                                <div class="equation">
                                                    <span>G(s) = </span>
                                                    <span class="numerator">3s<sup>3</sup> + 2s<sup>2</sup> - 5s + 7</span>
                                                    <span class="denominator">2s<sup>2</sup> - 4</span>
                                                </div>                                                
                                            </div>
                                        </div>


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


                                        @if ($camera1 != null)
                                            @if ($camera1->value != null)
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
                            <button disabled id="start" class="btn btn-md btn-primary  " onclick="runMotor();"
                                type="button"><i class="fa fa-play"></i> Run</button>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 ymodel mr-2">
                            <button disabled id="ymodel" class="btn btn-md btn-primary  " onclick="graphModel();"
                                type="button"> Find G(s)</button>
                        </div>

                        {{-- <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 velocidad" style="display: none;">
                            <p> <span id="velocidad"></span> cm </p>
                        </div> --}}

                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 stop" style="display: none;">
                            <button disabled id="stop" class="btn btn-md btn-success  " onclick="stopMotor();"
                                type="button"><i class="fa fa-stop"></i> Stop</button>
                        </div>

                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 download">
                            <button disabled id="download" class="btn btn-md btn-success  " onclick="descargar();"
                                type="button"><i class="fa fa-download"></i> DownLoad</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.0/socket.io.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.js"></script>  --}}

    <script type="text/javascript">
        var finish = '{{ $v_motor->finish_time }}';

        var urlVideo = 'https://viewer.millicast.com/v2?streamId=' + '{{ $camera1->value }}';
        var frame = false;
        var auxDiv = 0;
        startConnect();
        var toTeoria = true;
        var toTeoria = true;
        var timer1;
        var timer2;

        $(document).ready(function() {
            console.log("ready!");
            $('#datos1').hide();
            setTimeout(mostrarVideo, 5000);

            //timer1 = setTimeout(cambiar,180000);


            $('#nav-home-tab').click(function(e) {

                clearTimeout(timer1);
                clearTimeout(timer2);
                timer1 = setTimeout(cambiar, 180000);

                prepareFrame();
                $('.download').show();
                $('.ymodel').show();
                $('#camaraDiv').show();
                $('.stop').hide();
                $('.velocidad').hide();
                mode = 0;
                $('#datos1').show();
                $('#migrafica').show();

                if (auxDiv == 0) {
                    $("#padre").removeClass("col-lg-12");
                    $("#padre").addClass("col-lg-6");
                }
                auxDiv = 1;

            });


            $('#nav-profile-tab').click(function() {
                clearTimeout(timer1);
                clearTimeout(timer2);
                timer1 = setTimeout(cambiar, 180000);
                prepareFrame();
                $('.download').show();
                $('#camaraDiv').show();
                $('#datos1').hide();
                $('.ymodel').hide();
                $('.stop').show();
                mode = 1;
                auxControl = false;
                $('#velocidad').text(0);
                $('#migrafica').show();
                if (auxDiv == 0) {
                    $("#padre").removeClass("col-lg-12");
                    $("#padre").addClass("col-lg-6");
                }
                auxDiv = 1;
            });


            $('#nav-teoria-tab').click(function() {
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
                console.log("ir a teoria " + moment().format('hh:mm:ss'));
                $('#nav-teoria-tab').click();
            }
        }





        function cambiarTrue() {
            console.log("cambiando a true " + moment().format('hh:mm:ss'));
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
        var pwm = 0;
        var capture = 0;
        var labels = [];
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
        var client;


        var MAX_DATA_SET_LENGTH = 100;

        // Called after form input is processed
        function startConnect() {

            var date = Date.now();

            // Generate a random client ID
            clientID = "RemoteLAB" + date;

            console.log("startConnect " + clientID);

            //web socket con seguridad TSL wss
            const urlMqtt = 'wss://driver.cloudmqtt.com:38988/mqtt'

            // set callback handlers

            var options = {
                useSSL: false,
                username: 'echzdwoe',
                password: 'kf9t7h8fUTyZ'
            }
            // connect the client
            client = mqtt.connect(urlMqtt, options);
            client.on('connect', onConnect);
            client.on('message', onMessageArrived);
            client.on('error', doFail); // Manejador de errores
        }

        //Ver el mensaje que llega a RemoteLAB/
        client.on('message', function(topic, message) {
            // Verificar si el mensaje está en el topic deseado
            if (topic === 'RemoteLAB/') {
                console.log('Mensaje recibido en el topic RemoteLAB/: ' + message.toString());
            }
        });

        // Called when the client connects
        function onConnect() {
            console.log("onConnect");
            connect = true;
            $('#start').prop('disabled', false);
            // Fetch the MQTT topic from the form

            // Subscribe to the requested topic
            client.subscribe("RemoteLAB/speed_c");
            //client.subscribe("RemoteLAB/");
            // Publicar un mensaje en el tema "test"
            var mensaje = "¡Hola desde MQTT!";
            publish("test", mensaje);
        }

        function doFail(e) {
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

        //Recepcion de JSON ARDUINO
        //const JsonStreamingParser = require("arduino-json-streaming-parser");
        // Crea un nuevo analizador JSON
        //const parser = new JsonStreamingParser();

        // Called when a message arrives
        function onMessageArrived(topic, message) {

            //console.log("Mensaje recibido:");
            //console.log("Topic: " + topic);
            //console.log("Payload: " + message.toString());

            // Tu lógica para manejar los diferentes topics aquí
            if (topic == "RemoteLAB/speed_i") {
                // Lógica para procesar el topic "RemoteLAB/speed_i"
                //console.log("Recibiendo datos _ speedi");
                responseMotor(payloadObj);
            } else if (topic == "RemoteLAB/speed_c") {
                // Lógica para procesar el topic "RemoteLAB/speed_c"
                //console.log('Mensaje recibido en el topic RemoteLAB/speed_c:');
                responseMotorControl(message);
            } else {
                console.log("Mensaje recibido en un topic desconocido: " + topic);
            }
        }

        // Called when the disconnection button is pressed
        function startDisconnect() {
            client.disconnect();
        }


        // send a message

        function publish(topic, message) {
            console.log("Publicando en el tema: " + topic);
            client.publish(topic, message, {
                qos: 1
            }, function(error) {
                if (!error) {
                    console.log("Mensaje publicado con éxito en el tema: " + topic);
                } else {
                    console.error("Error al publicar mensaje en el tema " + topic + ": " + error);
                }
            });
        }


        function runMotor() {

            before = moment().isSameOrAfter(finish);
            toTeoria = false;
            if (!before) {
                if (connect) {
                    if (mode == 0) {
                        sinControl();
                    } else {
                        console.log("Run");
                        conControl();
                    }
                }
            } else {

                Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Se ha acabado el tiempo'
                });

                setTimeout(redirectProject, 2000);
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
            labels = [];
            voltaje = document.getElementById('pwm').value;
            voltaje = document.getElementById('pwm').value;
            pwm = document.getElementById('pwm').value;

            pwm = (parseFloat(pwm) * 8.5822) + 51.282;

            capture = document.getElementById('capture').value;
            sampling = document.getElementById('sampling').value;
            maxpwm = parseInt(pwm) + parseInt(pwm) * 0.5;
            a = (parseInt(pwm) * 160) / 100;


            data = JSON.stringify({
                sampling: sampling,
                pwm: pwm,
                capture: (capture * 1000)
            });

            mainGraph.options.scales.xAxes[0].ticks.max = parseInt(capture);
            mainGraph.update();

            cont++;

            publish("RemoteLAB/ident", data);

        }

        function conControl(argument) {
            $('#stop').prop('disabled', false);
            $('.velocidad').show();
            console.log("runnig...");
            if (!runnig) {
                mainGraph.clear();
                mainGraph.destroy();
// Crear un nuevo gráfico
                mainGraph = new Chart(chartEl, {
                    type: 'scatter',
                    data: lineChartData,
                    options: options,
                });
                mainGraph.data.datasets.forEach(dataset => {
                    dataset.data = [];
                });
                mainGraph.data.datasets[1].label = "Referencia";
                mainGraph.data.datasets[2].label = "Accion de Control";
                //mainGraph.options.scales.xAxes[0].ticks = {};
                mainGraph.options.scales.xAxes[0].ticks.max = 10; //establece el rango a 10 en escala de x
                mainGraph.options.scales.xAxes[0].ticks.maxTicksLimit = 20;
                //mainGraph.options.scales.xAxes[0].ticks.callback = getXAxisLabel;
                mainGraph.update();
            }
            mainGraph.data.datasets.forEach(dataset => {
                    dataset.data = [];
                });
            kd = document.getElementById('kd').value;
            ki = document.getElementById('ki').value;
            kp = document.getElementById('kp').value;
            sp = document.getElementById('sp').value;

            data = JSON.stringify({
                sampling: 50,
                capture: 10000,
                sp: sp,
                kd: kd,
                ki: ki,
                kp: kp,
            });
            publish("RemoteLAB/pid", data);
        }

        function getXAxisLabel(value) {
            try {
                var xMin = mainGraph.options.scales.xAxes[0].ticks.min;
                console.log("xMin = " + xMin);
            } catch (e) {
                var xMin = undefined;
                console.log("xMin no definido");
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
                label: "Posición",
                borderColor: 'red',
                yAxisID: 'A',
                pointBackgroundColor: 'red',
                fill: false,
                tension: 0,
                showLine: true,
                pointRadius: 0,
                pointHitRadius: 0,
                borderWidth: 2,
            }, {
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
            }, {
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
                        max: 10,
                        min: 0,
                        stepSize: 0.5,
                        beginAtZero: true,

                    }
                }],
                yAxes: [{
                    id: 'A',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        max: 50,
                        min: 0,
                        stepSize: 5,
                        beginAtZero: true,

                    }
                }, {
                    id: 'C',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        max: 160,
                        min: 0
                    }
                }, {
                    id: 'B',
                    type: 'linear',
                    display: false,
                    position: 'right',
                    ticks: {
                        max: 50,
                        min: 0,
                        stepSize: 5,
                        beginAtZero: true,
                    }
                }]
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
            k = (parseFloat(datamotor.y) / a).toFixed(3);
            $('#k').text(k);
            ytao = (0.632 * parseFloat(datamotor.y)).toFixed(3);
            mainGraph.data.datasets[0].data.push({
                x: datamotor.t,
                y: datamotor.y
            });
            mainGraph.data.datasets[2].data.push({
                x: datamotor.t,
                y: voltaje
            });
            mainGraph.update();
            if (parseFloat(datamotor.t) >= parseFloat(capture)) {
                $('#start').prop('disabled', false);
                $('#download').prop('disabled', false);
                $('#ymodel').prop('disabled', false);
                oTao = masCercano();
                runnig = false;
                clearTimeout(timer1);
                clearTimeout(timer2);
                timer2 = setTimeout(cambiarTrue, 180000);
                timer1 = setTimeout(cambiar, 240000);
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
            //console.log(datamotor);
            runnig = datamotor.run;
            console.log(parseFloat(datamotor.m));
            if (runnig) {
                if (parseFloat(datamotor.y) > 200) {
                    datamotor.y = ant;
                }
                ant = datamotor.y;
                var motorDataLength = mainGraph.data.datasets[0].data.length;

                /*if (motorDataLength > MAX_DATA_SET_LENGTH) {
                    mainGraph.data.datasets[0].data.shift();
                    mainGraph.data.datasets[1].data.shift();
                    mainGraph.data.datasets[2].data.shift();
                    //mainGraph.data.labels.shift();
                    //min = mainGraph.data.datasets[0].data[0].x;
                    //mainGraph.options.scales.xAxes[0].ticks.min = min;
                    //mainGraph.options.scales.xAxes[0].ticks.max = datamotor.t;
                }*/

                var v = parseFloat(datamotor.y).toFixed(0);
                if (cControl == 15) {
                    $('#velocidad').text(v);
                    cControl = 0;
                }
                cControl++;

                mainGraph.data.datasets[0].data.push({
                    x: datamotor.t,
                    y: datamotor.y
                });
                mainGraph.data.datasets[2].data.push({
                    x: datamotor.t,
                    y: datamotor.m
                });
                mainGraph.data.datasets[1].data.push({
                    x: datamotor.t,
                    y: datamotor.sp
                });
                mainGraph.update();

            } else {
                clearTimeout(timer1);
                clearTimeout(timer2);
                timer2 = setTimeout(cambiarTrue, 180000);
                timer1 = setTimeout(cambiar, 240000);
                Lobibox.notify('success', {
                    size: 'mini',
                    msg: 'Simulation successfully completed.'
                });
            }
        }


        $('.enter').bind("enterKey", function(e) {
            conControl();
        });


        $('.enter').keyup(function(e) {
            if (e.keyCode == 13) {
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
                csv += d_x + ";" + d_y;
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
                    if (Math.abs(value_y - ytao) < diferencia) {
                        cercano = value_y;
                        cercano_x = row.x;
                        diferencia = Math.abs(value_y - ytao);
                    }
                }
            });
            obj.x = cercano_x;
            obj.y = cercano;
            return obj;
        }

        function mostrarVideo() {
            $("#ytplayer").css("display", "block");
        }

        function graphModel() {
            if (!ymodel) {


                mainGraph.data.datasets[0].data.forEach(function(row) {
                    console.log(row);
                    var x = parseFloat(row.x);
                    var tao = parseFloat(oTao.x);
                    ym = (a * k) - (a * k * Math.exp(-x / tao));
                    console.log("tao:" + tao);
                    console.log("x_new:" + x);
                    console.log("ym:" + ym);
                    mainGraph.data.datasets[1].data.push({
                        x: row.x,
                        y: ym
                    });
                    mainGraph.update();
                });

            }

            ymodel = true;

        }

        function stopMotor() {
            console.log("stopMotor..");
            $('#download').prop('disabled',false);
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
            publish("RemoteLAB/pid", data);
        }


        function actualizarValorSP(input) {
            var valorSeleccionadoSpan = document.getElementById("valorSeleccionado");
            valorSeleccionadoSpan.textContent = input.value;
        }

        // Obtener el input de rango SP
        var inputRangoSP = document.getElementById("sp");

        // Actualizar el valor del rango SP al cargar la página
        actualizarValorSP(inputRangoSP);

        // Escuchar cambios en el input de rango SP y actualizar el valor
        inputRangoSP.addEventListener("input", function() {
            actualizarValorSP(this);
        });
    </script>
@endsection
@endsection
