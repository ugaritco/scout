<?php

use Heritage\Database\Eloquent\Model;
use Ugarit\Scout\Searchable;

use function PHPStan\Testing\assertType;

assertType('Ugarit\Scout\Builder<Post>', Post::search());

class Post extends Model
{
    use Searchable;
}
