<?php

namespace Ugarit\Scout\Console;

use Exception;
use Heritage\Console\Command;
use Ugarit\Scout\EngineManager;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'scout:delete-all-indexes')]
class DeleteAllIndexesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:delete-all-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all indexes';

    /**
     * Execute the console command.
     *
     * @param  \Ugarit\Scout\EngineManager  $manager
     * @return void
     */
    public function handle(EngineManager $manager)
    {
        $engine = $manager->engine();

        $driver = config('scout.driver');

        if (! method_exists($engine, 'deleteAllIndexes')) {
            return $this->error('The ['.$driver.'] engine does not support deleting all indexes.');
        }

        try {
            $manager->engine()->deleteAllIndexes();

            $this->info('All indexes deleted successfully.');
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
