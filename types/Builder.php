<?php

use Heritage\Database\Eloquent\Model;
use Ugarit\Scout\Builder;

use function PHPStan\Testing\assertType;

/** @param \Ugarit\Scout\Builder<User> $builder */
function test(
    Builder $builder,
): void {
    assertType('Heritage\Database\Eloquent\Collection<int, User>', $builder->get());
    assertType('User', $builder->first());
}

class User extends Model
{
}
