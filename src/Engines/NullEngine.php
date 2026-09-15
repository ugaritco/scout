<?php

namespace Ugarit\Scout\Engines;

use Heritage\Database\Eloquent\Collection;
use Heritage\Support\Collection as BaseCollection;
use Heritage\Support\LazyCollection;
use Ugarit\Scout\Builder;

class NullEngine extends Engine
{
    /**
     * Update the given model in the index.
     *
     * @param  \Heritage\Database\Eloquent\Collection  $models
     * @return void
     */
    public function update($models)
    {
        //
    }

    /**
     * Remove the given model from the index.
     *
     * @param  \Heritage\Database\Eloquent\Collection  $models
     * @return void
     */
    public function delete($models)
    {
        //
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @return mixed
     */
    public function search(Builder $builder)
    {
        return [];
    }

    /**
     * Perform the given search on the engine.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  int  $page
     * @return mixed
     */
    public function paginate(Builder $builder, $perPage, $page)
    {
        return [];
    }

    /**
     * Pluck and return the primary keys of the given results.
     *
     * @param  mixed  $results
     * @return \Heritage\Support\Collection
     */
    public function mapIds($results)
    {
        return BaseCollection::make();
    }

    /**
     * Map the given results to instances of the given model.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  mixed  $results
     * @param  \Heritage\Database\Eloquent\Model  $model
     * @return \Heritage\Database\Eloquent\Collection
     */
    public function map(Builder $builder, $results, $model)
    {
        return Collection::make();
    }

    /**
     * Map the given results to instances of the given model via a lazy collection.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  mixed  $results
     * @param  \Heritage\Database\Eloquent\Model  $model
     * @return \Heritage\Support\LazyCollection
     */
    public function lazyMap(Builder $builder, $results, $model)
    {
        return LazyCollection::make();
    }

    /**
     * Get the total count from a raw result returned by the engine.
     *
     * @param  mixed  $results
     * @return int
     */
    public function getTotalCount($results)
    {
        return count($results);
    }

    /**
     * Flush all of the model's records from the engine.
     *
     * @param  \Heritage\Database\Eloquent\Model  $model
     * @return void
     */
    public function flush($model)
    {
        //
    }

    /**
     * Create a search index.
     *
     * @param  string  $name
     * @param  array  $options
     * @return mixed
     */
    public function createIndex($name, array $options = [])
    {
        return [];
    }

    /**
     * Delete a search index.
     *
     * @param  string  $name
     * @return mixed
     */
    public function deleteIndex($name)
    {
        return [];
    }
}
