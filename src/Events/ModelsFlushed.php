<?php

namespace Ugarit\Scout\Events;

class ModelsFlushed
{
    /**
     * The model collection.
     *
     * @var \Heritage\Database\Eloquent\Collection
     */
    public $models;

    /**
     * Create a new event instance.
     *
     * @param  \Heritage\Database\Eloquent\Collection  $models
     * @return void
     */
    public function __construct($models)
    {
        $this->models = $models;
    }
}
