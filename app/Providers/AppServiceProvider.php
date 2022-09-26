<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Fumigadore;
use App\Models\Unidade;
use App\Models\Operadore;

use App\Observers\ClienteObserver;
use App\Observers\FumigadoreObserver;
use App\Observers\UnidadeObserver;
use App\Observers\OperadoreObserver;

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

    }
}
