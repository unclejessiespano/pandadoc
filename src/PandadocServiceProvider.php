<?php

namespace Bigandbrown\Pandadoc;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PandadocServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('pandadoc.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pandadoc', function ($app)
        {
            return new Pandadoc($app->config->get('pandadoc', array()));
        });
        $this->app->booting(function()
        {
            AliasLoader::getInstance()->alias('Pandadoc', 'Bigandbrown\Pandadoc\Facades\Pandadoc');
        });
    }

    public function provides()
    {
        return ['pandadoc'];
    }
}
