<?php

namespace App\Providers;

use App\Myservice\NomorService;
use Illuminate\Support\ServiceProvider;

class NomorProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('NomorService',function(){
            return new NomorService();
        });
    }
}
