<?php

namespace Ugarit\Scout;

use Heritage\Database\Eloquent\Builder as EloquentBuilder;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\HasManyThrough;
use Heritage\Database\Eloquent\Scope;
use Ugarit\Scout\Events\ModelsFlushed;
use Ugarit\Scout\Events\ModelsImported;

class SearchableScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Heritage\Database\Eloquent\Builder  $builder
     * @param  \Heritage\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(EloquentBuilder $builder, Model $model)
    {
        //
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Heritage\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(EloquentBuilder $builder)
    {
        $builder->macro('searchable', function (EloquentBuilder $builder, $chunk = null) {
            $scoutKeyName = $builder->getModel()->getScoutKeyName();

            $builder->chunkById($chunk ?: config('scout.chunk.searchable', 500), function ($models) {
                $models->filter->shouldBeSearchable()->searchable();

                event(new ModelsImported($models));
            }, $builder->qualifyColumn($scoutKeyName), $scoutKeyName);
        });

        $builder->macro('unsearchable', function (EloquentBuilder $builder, $chunk = null) {
            $scoutKeyName = $builder->getModel()->getScoutKeyName();

            $builder->chunkById($chunk ?: config('scout.chunk.unsearchable', 500), function ($models) {
                $models->unsearchable();

                event(new ModelsFlushed($models));
            }, $builder->qualifyColumn($scoutKeyName), $scoutKeyName);
        });

        HasManyThrough::macro('searchable', function ($chunk = null) {
            /** @var HasManyThrough $this */
            $this->chunkById($chunk ?: config('scout.chunk.searchable', 500), function ($models) {
                $models->filter->shouldBeSearchable()->searchable();

                event(new ModelsImported($models));
            });
        });

        HasManyThrough::macro('unsearchable', function ($chunk = null) {
            /** @var HasManyThrough $this */
            $this->chunkById($chunk ?: config('scout.chunk.unsearchable', 500), function ($models) {
                $models->unsearchable();

                event(new ModelsFlushed($models));
            });
        });
    }
}
