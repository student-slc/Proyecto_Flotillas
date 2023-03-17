@php
    $usuario = \Auth::user();
    $rol = $usuario->rol;
@endphp
<li class="side-menus">
<li class="{{ request()->routeIs('home') ? 'active' : '' }}">
    <a class="nav-link active" href="{{ route('home') }}" data-bs-toggle="tooltip" data-bs-placement="right"
        title=" Dashboard Principal">
        <i class="fas fa-table"></i><span>Dashboard</span>
    </a>
</li>
<li class="dropdown">
    <a href="#" class="nav-link has-dropdown active"><i class="far fa-file-alt"></i> <span>Reportes</span></a>
    <ul class="dropdown-menu">
        <li><a href="{{ route('tabla_reportes.reporte_flotillas') }}">Flotillas</a></li>
        <li><a href="{{ route('tabla_reportes.reporte_seguros') }}">Seguros de Resp. Civil</a></li>
        <li><a href="{{ route('tabla_reportes.reporte_verificaciones') }}">Verificaciones</a></li>
        {{-- <li><a href="{{ route('tabla_reportes.reporte_fumigaciones') }}">Fumigaciones Acumuladas</a></li> --}}
        <li><a href="{{ route('tabla_reportes.reporte_semanal') }}">Fumigaciones Realizadas</a></li>
        <li><a href="{{ route('tabla_reportes.reporte_dia') }}">Fumigaciones Proximas</a></li>
        <li><a href="{{ route('tabla_reportes.reporte_individualv') }}">Individual Vehicular</a></li>
        {{-- <li><a href="{{ route('tabla_reportes.reporte_individualv') }}">Individual Habitacional</a></li> --}}
        <li><a href="{{ route('tabla_reportes.reporte_individual') }}">Individual Operador</a></li>
        {{-- <li><a href="{{ route('tabla_reportes.reporte_satisfaccion') }}">Satisfacción de Servicio. F.</a></li> --}}
    </ul>
</li>

<li class="{{ request()->is('usuarios') ? 'active' : '' }}">
    @can('general-rol')
        <a class="nav-link" href="{{ route('usuarios.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Usuarios">
            <i class=" fas fa-users"></i><span>Usuarios</span>
        </a>
    @endcan
</li>

<li class="{{ request()->is('roles') ? 'active' : '' }}">
    @can('general-rol')
        @if ($rol == 'SuperAdministrador')
            <a class="nav-link" href="{{ route('roles.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
                title="Roles">
                <i class=" fas fa-user-lock"></i><span>Roles</span>
            </a>
        @endif
    @endcan
</li>

<li class="{{ request()->is('clientes') ? 'active' : '' }}">
    @can('general-rol')
        <a class="nav-link" href="{{ route('clientes.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Clientes">
            <i class=" fas fa-user-tie"></i><span>Clientes</span>
        </a>
    @endcan
</li>

<li class="{{ request()->is('folios') ? 'active' : '' }}">
    @can('general-rol')
        <a class="nav-link" href="{{ route('folios.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Folios">
            <i class=" fas fa-file-text"></i><span>Folios</span>
        </a>
    @endcan
</li>

<li class="{{ request()->is('clientes') ? 'active' : '' }}">
    @can('particular-rol')
        <a class="nav-link" href="{{ route('clientes.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Clientes">
            <i class=" fas fa-user-tie"></i><span>Mi Información</span>
        </a>
    @endcan
</li>

<li class="{{ request()->is('fumigadores') ? 'active' : '' }}">
    @can('general-rol')
        <a class="nav-link" href="{{ route('fumigadores.index') }}" data-bs-toggle="tooltip" data-bs-placement="right"
            title="Fumigadores">
            <i class=" fas fa-id-card"></i><span>Fumigadores</span>
        </a>
    @endcan
</li>


{{-- <a class="nav-link" href="/fumigaciones">
        <i class=" fas fa-bug"></i><span>Fumigaciones</span>
    </a> --}}

<li class="{{ request()->is('logs') ? 'active' : '' }}">
    <a class="nav-link" href="">
        <i class="fas fa-dollar-sign"></i><span>Cotizaciones</span>
    </a>
</li>

<li class="{{ request()->is('folios') ? 'active' : '' }}">
    @can('general-rol')
        <a class="nav-link" href="">
            <i class="fas fa-clipboard-list"></i><span>logs</span>
        </a>
    @endcan
</li>

<li class="{{ request()->is('arranque_unidad') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('checklist.arranque') }}" data-bs-toggle="tooltip" data-bs-placement="right"
        title="Arranque">
        <i class="fas fa-clipboard-list"></i><span>Arranque Unidades</span>
    </a>
</li>

<li class="{{ request()->is('regreso_unidad') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('checklist.regreso') }}" data-bs-toggle="tooltip" data-bs-placement="right"
        title="Regreso">
        <i class="fas fa-clipboard-list"></i><span>Regreso Unidades</span>
    </a>
</li>



</li>
