<?php

namespace App\Observers;
use App\Models\Cliente;
use App\Models\Log;
use Illuminate\Http\Request;


class ClienteObserver
{
    /**
     * Handle the Cliente "created" event.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return void
     */
    public function created(Cliente $cliente)
    {
        $log= new Log();
        $log->event='Se Creo al Cliente: ';
        $log->dato=request('nombrecompleto');
        $log->save();
    }

    /**
     * Handle the Camarista "updated" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function updated(Cliente $cliente)
    {
        $log= new Log();
        $log->event='Se Actualizo al Cliente: ';
        $log->dato=request('nombrecompleto');
        $log->save();
    }

    /**
     * Handle the Camarista "deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function deleted(Cliente $cliente)
    {
        $log= new Log();
        $log->event='Se Elimino al Cliente: ';
        $log->dato=$cliente->nombrecompleto;
        $log->save();
    }

    /**
     * Handle the Camarista "restored" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function restored(Cliente $cliente)
    {
        //
    }

    /**
     * Handle the Camarista "force deleted" event.
     *
     * @param  \App\Models\Camarista  $cliente
     * @return void
     */
    public function forceDeleted(Cliente $cliente)
    {
        //
    }
}
