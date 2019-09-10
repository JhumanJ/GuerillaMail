<?php

namespace JhumanJ\GuerillaMail;

use Illuminate\Support\ServiceProvider;

class GuerillaMailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('guerilla-mail', function($app) {
            return new GuerillaMailFacade();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
