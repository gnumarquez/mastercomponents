<?php

namespace Gnumarquez;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Gnumarquez\MasterComponents\livewire\WhatsappNotification;


class MasterComponentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->registerCommands();
        //$this->loadRoutesFrom(__DIR__.'/routes.php');
        Livewire::component('whatsapp-notification', WhatsappNotification::class);
    }

    

}