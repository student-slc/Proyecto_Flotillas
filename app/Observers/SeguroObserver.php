<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Seguro;

class SeguroObserver
{
    /**
     * Handle the Seguro "created" event.
     *
     * @param  \App\Models\Seguro  $seguro
     * @return void
     */
    public function created(Seguro $seguro)
    {
        $log= new Log();
        $log->event='Seguro Creado para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Seguro $seguro)
    {
        $log= new Log();
        $log->event='Seguro Actualizado para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Seguro $seguro)
    {
        $log= new Log();
        $log->event='Seguro Eliminado para la unidad:';
        $log->dato=$seguro->id_unidad;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Seguro $seguro)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Seguro $seguro)
    {
        //
    }
}
