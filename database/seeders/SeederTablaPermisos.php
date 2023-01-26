<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        @can('crear-camarista')
                                <a class="btn btn-warning" href="{{ route('camaristas.create') }}">Agregar Camarista</a>
                            @endcan */
        $permisos = [
            /* =============== PARTICULAR\GENERAL-PERMISOS =============== */
            'general-rol',
            'particular-rol',
            /* =============== ROLES-PERMISOS =============== */
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            /* =============== DASHBOARD-PERMISOS =============== */
            'ver-dashboard',
            'enviar-mails',
            /* =============== USUARIOS-PERMISOS =============== */
            'ver-usuarios',
            'crear-usuarios',
            'editar-usuarios',
            'borrar-usuarios',
            /* =============== CLIENTES-PERMISOS =============== */
            'ver-clientes',
            'crear-clientes',
            'editar-clientes',
            'borrar-clientes',
            /* =============== UNIDADES-PERMISOS =============== */
            'ver-unidades',
            'crear-unidades',
            'editar-unidades',
            'borrar-unidades',
            /* =============== OPERADORES-PERMISOS =============== */
            'ver-operadores',
            'crear-operadores',
            'editar-operadores',
            'borrar-operadores',
            /* =============== FUMIGADORES-PERMISOS =============== */
            'ver-fumigadores',
            'crear-fumigadores',
            'editar-fumigadores',
            'borrar-fumigadores',
        ];
        foreach ($permisos as $permiso) {
            Permission::create(['name' => $permiso]);
        }
    }
}
