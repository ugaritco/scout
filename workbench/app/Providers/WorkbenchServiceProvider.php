<?php

namespace Workbench\App\Providers;

use Heritage\Support\ServiceProvider;
use Ugarit\Scout\EngineManager;
use Ugarit\Scout\Engines\NullEngine;
use Mockery as m;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('scout.spied', function () {
            return m::spy(NullEngine::class);
        });

        $this->callAfterResolving(EngineManager::class, function ($engine, $app) {
            $engine->extend('testing', function () use ($app) {
                return $app->make('scout.spied');
            });
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
