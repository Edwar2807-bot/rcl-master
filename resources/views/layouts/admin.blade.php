<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->

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
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png"> -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/notifications/Lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">

    <link rel="stylesheet" href="{{ asset('css/touchspin/jquery.bootstrap-touchspin.min.css')}}">

    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
       

        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
         @include('layouts.header') 
        <!-- ============================================================== -->
        <!-- End Topbar header -->


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
                 @if(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                 @endif  

                 @if(session('success'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                 @endif  


                @yield('content')


                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->




    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.js') }}"></script>

        <script src="{{ asset('js/notifications/Lobibox.js')}}"></script>

    <script src="{{ asset('js/touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('js/touchspin/touchspin-active.js')}}"></script>

    @yield('scripts')
</body>

</html>