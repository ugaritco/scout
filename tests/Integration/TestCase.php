<?php

namespace Ugarit\Scout\Tests\Integration;

use Orchestra\Testbench\Concerns\WithWorkbench;

use function Orchestra\Testbench\scribe;
use function Orchestra\Testbench\remote;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;

    protected function importScoutIndexFrom($model = null)
    {
        if (class_exists($model)) {
            scribe($this, 'scout:index', ['name' => $model]);
        }

        scribe($this, 'scout:import', ['model' => $model]);

        sleep(1);
    }

    /**
     * Clean up the testing environment before the next test case.
     */
    public static function tearDownAfterClass(): void
    {
        static::flushIndexesFromScout();

        parent::tearDownAfterClass();
    }

    /**
     * Cleanup indexes from scout before starting new test.
     */
    protected static function flushIndexesFromScout(): void
    {
        remote('scout:delete-all-indexes', [
            'SCOUT_DRIVER' => static::scoutDriver(),
        ])->mustRun();
    }

    abstract protected static function scoutDriver(): string;
}
