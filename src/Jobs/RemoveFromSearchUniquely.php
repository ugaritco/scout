<?php

namespace Ugarit\Scout\Jobs;

use Heritage\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Ugarit\Scout\Traits\UniqueByScoutKeys;

class RemoveFromSearchUniquely extends RemoveFromSearch implements ShouldBeUniqueUntilProcessing
{
    use UniqueByScoutKeys;
}
