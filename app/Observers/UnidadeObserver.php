<?php

namespace App\Observers;

use App\Models\Unidade;
use App\Models\Log;


class UnidadeObserver
{
    /**
     * Handle the Unidade "created" event.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return void
     */
    public function created(Unidade $unidade)
    {
        $log= new Log();
        $log->event='Se Creo la Unidad:';
        $log->dato=request('serieunidad');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Unidade $unidade)
    {
        $log= new Log();
        $log->event='Se Actualizo la Unidad:';
        $log->dato=request('serieunidad');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Unidade $unidade)
    {
        $log= new Log();
        $log->event='Se Elimino la Unidad:';
        $log->dato=$unidade->serieunidad;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Unidade $unidade)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Unidade $unidade)
    {
        //
    }
}
