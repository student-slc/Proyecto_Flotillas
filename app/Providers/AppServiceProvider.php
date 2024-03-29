<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Fumigacione;
use App\Models\Fumigadore;
use App\Models\Unidade;
use App\Models\Operadore;
use App\Models\Seguro;
use App\Models\Verificacione;
use App\Models\Mantenimiento;

use App\Observers\ClienteObserver;
use App\Observers\FumigacioneObserver;
use App\Observers\FumigadoreObserver;
use App\Observers\UnidadeObserver;
use App\Observers\OperadoreObserver;
use App\Observers\SeguroObserver;
use App\Observers\VerificacioneObserver;
use App\Observers\MantenimientoObserver;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        //Observadores
        Cliente::observe(ClienteObserver::class);
        Unidade::observe(UnidadeObserver::class);
        Operadore::observe(OperadoreObserver::class);
        Fumigadore::observe(FumigadoreObserver::class);
        Fumigacione::observe(FumigacioneObserver::class);
        Seguro::observe(SeguroObserver::class);
        Verificacione::observe(VerificacioneObserver::class);
        Mantenimiento::observe(MantenimientoObserver::class);
    }
}
