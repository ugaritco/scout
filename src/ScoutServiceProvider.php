<?php

namespace Ugarit\Scout;

use Heritage\Http\Client\Factory as HttpFactory;
use Heritage\Support\ServiceProvider;
use Ugarit\Scout\Console\DeleteAllIndexesCommand;
use Ugarit\Scout\Console\DeleteIndexCommand;
use Ugarit\Scout\Console\FlushCommand;
use Ugarit\Scout\Console\ImportCommand;
use Ugarit\Scout\Console\IndexCommand;
use Ugarit\Scout\Console\QueueImportCommand;
use Ugarit\Scout\Console\SyncIndexSettingsCommand;
use Ugarit\Scout\Services\Turbopuffer\TurbopufferClient;
use Meilisearch\Client as Meilisearch;

class ScoutServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/scout.php', 'scout');

        if (class_exists(Meilisearch::class)) {
            $this->app->singleton(Meilisearch::class, function ($app) {
                $config = $app['config']->get('scout.meilisearch');

                return new Meilisearch(
                    $config['host'],
                    $config['key'],
                    clientAgents: [sprintf('Meilisearch Ugarit Scout (v%s)', Scout::VERSION)],
                );
            });
        }

        $this->app->singleton(TurbopufferClient::class, function ($app) {
            return new TurbopufferClient(
                $app->make(HttpFactory::class),
                $app['config']->get('scout.turbopuffer', []),
            );
        });

        $this->app->singleton(EngineManager::class, function ($app) {
            return new EngineManager($app);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                QueueImportCommand::class,
                FlushCommand::class,
                ImportCommand::class,
                IndexCommand::class,
                SyncIndexSettingsCommand::class,
                DeleteIndexCommand::class,
                DeleteAllIndexesCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/scout.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'scout.php',
            ]);
        }
    }
}
