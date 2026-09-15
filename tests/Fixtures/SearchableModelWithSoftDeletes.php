<?php

namespace Ugarit\Scout\Tests\Fixtures;

use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\SoftDeletes;
use Ugarit\Scout\Searchable;

class SearchableModelWithSoftDeletes extends Model
{
    use Searchable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['published_at'];

    public function shouldBeSearchable()
    {
        return ! $this->trashed() && ! is_null($this->published_at);
    }
}
