<?php

namespace Ugarit\Scout\Contracts;

use Ugarit\Scout\Builder;

interface PaginatesEloquentModelsUsingDatabase
{
    /**
     * Paginate the given search on the engine.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  string  $pageName
     * @param  int  $page
     * @return \Heritage\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateUsingDatabase(Builder $builder, $perPage, $pageName, $page);

    /**
     * Paginate the given search on the engine using simple pagination.
     *
     * @param  \Ugarit\Scout\Builder  $builder
     * @param  int  $perPage
     * @param  string  $pageName
     * @param  int  $page
     * @return \Heritage\Contracts\Pagination\Paginator
     */
    public function simplePaginateUsingDatabase(Builder $builder, $perPage, $pageName, $page);
}
