<?php

namespace Gtk\Larasearch;

use Illuminate\Support\ServiceProvider;
use Gtk\Larasearch\Console\FlushCommand;
use Gtk\Larasearch\Console\ImportCommand;

class LarasearchServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EngineManager::class, function ($app) {
            return new EngineManager($app);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCommand::class,
                FlushCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/larasearch.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'larasearch.php',
            ]);
        }
    }
}
