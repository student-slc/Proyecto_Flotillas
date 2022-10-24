<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Mantenimiento;
class MantenimientoObserver
{
     /**
     * Handle the Seguro "created" event.
     *
     * @param  \App\Models\Seguro  $seguro
     * @return void
     */
    public function created(Mantenimiento $mantenimiento)
    {
        $log= new Log();
        $log->event='Mantenimiento Creado para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Mantenimiento $mantenimiento)
    {
        $log= new Log();
        $log->event='Mantenimiento Actualizado para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Mantenimiento $mantenimiento)
    {
        $log= new Log();
        $log->event='Mantenimiento Eliminado para la unidad:';
        $log->dato=$mantenimiento->id_unidad;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Mantenimiento $mantenimiento)
    {
        //
    }
}
