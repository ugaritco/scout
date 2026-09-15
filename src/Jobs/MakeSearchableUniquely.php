<?php

namespace Ugarit\Scout\Jobs;

use Heritage\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Ugarit\Scout\Traits\UniqueByScoutKeys;

class MakeSearchableUniquely extends MakeSearchable implements ShouldBeUniqueUntilProcessing
{
    use UniqueByScoutKeys;
}
