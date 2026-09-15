<?php

namespace Ugarit\Scout\Jobs;

use Heritage\Bus\Queueable;
use Heritage\Contracts\Queue\ShouldQueue;
use Heritage\Queue\SerializesModels;
use Ugarit\Scout\Traits\ConfiguresJobOptions;

class RemoveFromSearch implements ShouldQueue
{
    use ConfiguresJobOptions, Queueable, SerializesModels;

    /**
     * The models to be removed from the search index.
     *
     * @var \Ugarit\Scout\Jobs\RemoveableScoutCollection
     */
    public $models;

    /**
     * Create a new job instance.
     *
     * @param  \Heritage\Database\Eloquent\Collection  $models
     * @return void
     */
    public function __construct($models)
    {
        $this->models = RemoveableScoutCollection::make($models);

        $this->configureJob();
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->models->isNotEmpty()) {
            $this->models->first()->searchableUsing()->delete($this->models);
        }
    }

    /**
     * Restore a queueable collection instance.
     *
     * @param  \Heritage\Contracts\Database\ModelIdentifier  $value
     * @return \Ugarit\Scout\Jobs\RemoveableScoutCollection
     */
    protected function restoreCollection($value)
    {
        if (! $value->class || count($value->id) === 0) {
            return new RemoveableScoutCollection;
        }

        return new RemoveableScoutCollection(
            collect($value->id)->map(function ($id) use ($value) {
                return tap(new $value->class, function ($model) use ($id) {
                    $model->setKeyType(
                        is_string($id) ? 'string' : 'int'
                    )->forceFill([
                        $model->getScoutKeyName() => $id,
                    ]);
                });
            })
        );
    }
}
