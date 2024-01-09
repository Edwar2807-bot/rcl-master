<header class="topbar" data-navbarbg="skin5">
<nav class="navbar top-navbar navbar-expand-md navbar-dark">
<div class="navbar-header" data-logobg="skin5">
    <!-- ============================================================== -->
    <!-- Logo -->
    <!-- ============================================================== -->
    <a class="navbar-brand" href="/">
        <!-- Logo icon -->
        <b class="logo-icon">
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            
            <img src="{{ asset('img/redtech.png') }}"  width="180" height="50" alt="homepage" class="dark-logo" />
            <!-- Light Logo icon -->
            <img src="{{ asset('img/redtech.png') }}" width="180" height="50" alt="homepage" class="light-logo" />
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->

    </a>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <!-- This is for the sidebar toggle which is visible on mobile only -->
    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
</div>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->
<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
    <!-- ============================================================== -->
    <!-- toggle and nav items -->
    <!-- ============================================================== -->
    <ul class="navbar-nav float-left mr-auto">
         
    </ul>
    <!-- ============================================================== -->
    <!-- Right side toggle and nav items -->
    <!-- ============================================================== -->
    <ul class="navbar-nav float-right">
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-user m-r-5 m-l-5"></i>{{ Auth::user()->usuario }}</a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
    </ul>
</div>
</nav>
</header>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>