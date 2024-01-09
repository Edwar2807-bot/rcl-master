<aside class="left-sidebar" data-sidebarbg="skin6">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">

        	@if(Auth::user()->rol == 1)

            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('parameters.index') }}" aria-expanded="false"><i class="mdi mdi-camera"></i><span class="hide-menu">Camaras</span></a></li>

        	<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('docentes.index') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Docentes</span></a></li>
        	@endif

        	@if(Auth::user()->rol != 3)
        	<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('estudiantes.index') }}" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Estudiantes</span></a></li>
        	@endif

            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('appointments.index',['lab' => 1]) }}" aria-expanded="false"><i class="mdi mdi-calendar"></i><span class="hide-menu">Agenda</span></a></li>


            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('projects.index') }}" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Proyectos</span></a></li>

        </ul>
        
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
</aside>