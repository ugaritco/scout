<?php

namespace Workbench\App\Models;

use Heritage\Database\Eloquent\Builder;
use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\BelongsTo;
use Ugarit\Scout\Searchable;

class Bookmark extends Model
{
    use HasFactory;
    use Searchable;

    public function chirp(): BelongsTo
    {
        return $this->belongsTo(Chirp::class);
    }

    public function newScoutQuery(): Builder
    {
        return $this->newQuery()->join('chirps', 'chirps.id', '=', 'bookmarks.chirp_id');
    }

    public function toSearchableArray()
    {
        if (isset($_ENV['bookmark.toSearchableArray'])) {
            return value($_ENV['bookmark.toSearchableArray'], $this);
        }

        return [
            'label' => $this->label,
            'chirps.content' => '',
        ];
    }
}
