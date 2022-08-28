<?php

namespace Gnumarquez;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Gnumarquez\Http\Livewire\WhatsappNotification;
use Gnumarquez\Http\Livewire\UsersComponent;


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
        Livewire::component('whatsapp-notification', WhatsappNotification::class);
        Livewire::component('users-component', UsersComponent::class);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views','mastercomponents');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    

}