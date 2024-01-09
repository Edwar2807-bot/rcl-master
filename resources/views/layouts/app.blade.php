<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>RemoteLAB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Los RemoteLAB (Laboratorios remotos) se integran en espacios ciber-físicos, es decir,
no son laboratorios o simuladores virtuales, sino que usan el software para conectarse a
un espacio real de tal forma que se pueda manipular objetos, dispositivos o equipos a
distancia mediante un computador con acceso a internet.">
    <meta name="author" content="RemoteLAB">
    <meta property="og:title" content="RemoteLAB" />
    <meta property="og:description" content="Los RemoteLAB (Laboratorios remotos) se integran en espacios ciber-físicos, es decir,
no son laboratorios o simuladores virtuales, sino que usan el software para conectarse a
un espacio real de tal forma que se pueda manipular objetos, dispositivos o equipos a
distancia mediante un computador con acceso a internet."/>

<meta property="og:image" content="http://www.lab-remoto.com/img/redtech.png">

<meta name="keywords" content="lab-remoto,remotelab,control pid"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
