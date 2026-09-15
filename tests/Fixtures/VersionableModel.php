<?php

namespace Ugarit\Scout\Tests\Fixtures;

use Heritage\Database\Eloquent\Model;
use Ugarit\Scout\Searchable;

class VersionableModel extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

    public function searchableAs()
    {
        return 'table';
    }

    public function indexableAs()
    {
        return 'table_v2';
    }
}
