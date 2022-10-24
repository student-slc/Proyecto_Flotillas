<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\Verificacione;
class VerificacioneObserver
{
    /**
     * Handle the Seguro "created" event.
     *
     * @param  \App\Models\Seguro  $seguro
     * @return void
     */
    public function created(Verificacione $verificacione)
    {
        $log= new Log();
        $log->event='Verificación Creada para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Verificacione $verificacione)
    {
        $log= new Log();
        $log->event='Verificación Actualizada para la unidad:';
        $log->dato=request('id_unidad');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Verificacione $verificacione)
    {
        $log= new Log();
        $log->event='Verificación Eliminada para la unidad:';
        $log->dato=$verificacione->id_unidad;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Verificacione $verificacione)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Verificacione $verificacione)
    {
        //
    }
}
