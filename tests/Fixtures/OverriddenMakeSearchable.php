<?php

namespace Ugarit\Scout\Tests\Fixtures;

use Ugarit\Scout\Jobs\MakeSearchable;

class OverriddenMakeSearchable extends MakeSearchable
{
    public $tries = 5;

    public $maxExceptions = 3;

    public $failOnTimeout = false;

    public function backoff(): array
    {
        return [2, 4, 8, 16, 32];
    }
}
