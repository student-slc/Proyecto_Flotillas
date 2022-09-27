<?php

namespace App\Observers;

use App\Models\Fumigacione;
use App\Models\Log;

class FumigacioneObserver
{
    /**
     * Handle the Fumigacione "created" event.
     *
     * @param  \App\Models\Fumigacione  $fumigacione
     * @return void
     */
    public function created(Fumigacione $fumigacione)
    {
        $log= new Log();
        $log->event='Fumigacion Creada:';
        $log->dato=request('id_cliente');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Fumigacione $fumigacione)
    {
        $log= new Log();
        $log->event='Fumigacion Actualizada:';
        $log->dato=request('id_cliente');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Fumigacione $fumigacione)
    {
        $log= new Log();
        $log->event='Fumigacion Eliminada:';
        $log->dato=$fumigacione->id_cliente;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Fumigacione $fumigacione)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Fumigacione $fumigacione)
    {
        //
    }
}
