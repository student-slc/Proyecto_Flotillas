<?php

namespace App\Observers;

use App\Models\Operadore;
use App\Models\Log;

class OperadoreObserver
{
    /**
     * Handle the Operadore "created" event.
     *
     * @param  \App\Models\Operadore  $operadore
     * @return void
     */
    public function created(Operadore $operadore)
    {
        $log= new Log();
        $log->event='Se Creo al Operador:';
        $log->dato=request('nombreoperador');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Operadore $operadore)
    {
        $log= new Log();
        $log->event='Se Actualizo al Operador:';
        $log->dato=request('nombreoperador');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Operadore $operadore)
    {
        $log= new Log();
        $log->event='Se Elimino al Operador:';
        $log->dato=$operadore->nombreoperador;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Operadore $operadore)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Operadore $operadore)
    {
        //
    }
}
