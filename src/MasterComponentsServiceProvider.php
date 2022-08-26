<?php

namespace Gnumarquez;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Gnumarquez\Http\Livewire\WhatsappNotification;


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
        $this->loadViewsFrom(__DIR__.'/../resources/views','mastercomponents'); 
        Livewire::component('whatsapp-notification', WhatsappNotification::class);
    }

    

}