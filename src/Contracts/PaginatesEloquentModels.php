<?php

namespace Ugarit\Scout\Contracts;

use Ugarit\Scout\Builder;

interface PaginatesEloquentModels
{
    /**
     * Paginate the given search on the engine.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  int  $page
     * @return \Heritage\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(Builder $builder, $perPage, $page);

    /**
     * Paginate the given search on the engine using simple pagination.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  int  $page
     * @return \Heritage\Contracts\Pagination\Paginator
     */
    public function simplePaginate(Builder $builder, $perPage, $page);
}
