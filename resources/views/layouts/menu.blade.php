<li class="side-menus active">
    <a class="nav-link" href="/home">
        <i class="fas fa-table"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-table"></i><span>Reportes</span>
    </a>
    @can('general-rol')
        <a class="nav-link" href="/usuarios">
            <i class=" fas fa-users"></i><span>Usuarios</span>
        </a>
    @endcan
    @can('general-rol')
        <a class="nav-link" href="/roles">
            <i class=" fas fa-user-lock"></i><span>Roles</span>
        </a>
    @endcan
    @can('general-rol')
        <a class="nav-link" href="/clientes">
            <i class=" fas fa-user-tie"></i><span>Clientes</span>
        </a>
    @endcan
    @can('particular-rol')
        <a class="nav-link" href="/clientes">
            <i class=" fas fa-user-tie"></i><span>Mi Información</span>
        </a>
    @endcan
    @can('general-rol')
        <a class="nav-link" href="/fumigadores">
            <i class=" fas fa-id-card"></i><span>Fumigadores</span>
        </a>
    @endcan
    {{-- <a class="nav-link" href="/fumigaciones">
        <i class=" fas fa-bug"></i><span>Fumigaciones</span>
    </a> --}}
    <a class="nav-link" href="/logs">
        <i class="fas fa-dollar-sign"></i><span>Cotizaciones</span>
    </a>
    @can('general-rol')
        <a class="nav-link" href="/logs">
            <i class="fas fa-clipboard-list"></i><span>logs</span>
        </a>
    @endcan
    <a class="nav-link" href="/arranque_unidad">
        <i class="fas fa-clipboard-list"></i><span>Arranque Unidades</span>
    </a>
    <a class="nav-link" href="/regreso_unidad">
        <i class="fas fa-clipboard-list"></i><span>Regreso Unidades</span>
    </a>
</li>
