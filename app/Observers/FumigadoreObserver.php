<?php

namespace App\Observers;

use App\Models\Fumigadore;
use App\Models\Log;


class FumigadoreObserver
{
    /**
     * Handle the Fumigadore "created" event.
     *
     * @param  \App\Models\Fumigadore  $fumigadore
     * @return void
     */
    public function created(Fumigadore $fumigadore)
    {
        $log= new Log();
        $log->event='Se Creo al Fumigador:';
        $log->dato=request('nombrecompleto');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Fumigadore $fumigadore)
    {
        $log= new Log();
        $log->event='Se Actualizo al Fumigador:';
        $log->dato=request('nombrecompleto');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Fumigadore $fumigadore)
    {
        $log= new Log();
        $log->event='Se Elimino al Fumigador:';
        $log->dato=$fumigadore->nombrecompleto;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Fumigadore $fumigadore)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Fumigadore $fumigadore)
    {
        //
    }
}
