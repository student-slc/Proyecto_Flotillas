{{--  --}}
<li class="side-menus {{-- active --}}">
    <a class="nav-link" href="/home" >
        <i class="fas fa-table"></i><span>Dashboard</span>
    </a>
</li>
<li class="side-menus dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
        aria-expanded="false">
        <i class=" fas fa-chart-bar"></i><span>Reportes</span>
    </a>
    <div class="dropdown-menu">
        <a class="nav-link dropdown-item" href="{{ route('reportes.seguros') }}">
            <i class=" fas fa-chart-bar"></i><span>Seguros</span>
        </a>
        <a class="nav-link dropdown-item" href="{{ route('reportes.vambiental') }}">
            <i class=" fas fa-chart-bar"></i><span>Verificación Ambiental</span>
        </a>
        <a class="nav-link dropdown-item" href="{{ route('reportes.vfisica') }}">
            <i class=" fas fa-chart-bar"></i><span>Verificación F.Mecánica</span>
        </a>
        <a class="nav-link dropdown-item" href="{{ route('reportes.mantenimientos') }}">
            <i class=" fas fa-chart-bar"></i><span>Mantenimiento</span>
        </a>
    </div>
</li>
{{--  --}}
<li class="side-menus {{-- active --}}">
    <a class="nav-link" href="/usuarios">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
    <a class="nav-link" href="/clientes">
        <i class=" fas fa-user-tie"></i><span>Clientes</span>
    </a>
    <a class="nav-link" href="/fumigadores">
        <i class=" fas fa-id-card"></i><span>Fumigadores</span>
    </a>
    <a class="nav-link" href="/fumigaciones">
        <i class=" fas fa-bug"></i><span>Fumigaciones</span>
    </a>
    <a class="nav-link" href="/logs">
        <i class="fas fa-dollar-sign"></i><span>Cotizaciones</span>
    </a>
    <a class="nav-link" href="/logs">
        <i class="fas fa-clipboard-list"></i><span>logs</span>
    </a>
</li>
