<?php

namespace Ugarit\Scout\Jobs;

use Heritage\Bus\Queueable;
use Heritage\Contracts\Queue\ShouldQueue;
use Heritage\Queue\SerializesModels;
use Ugarit\Scout\Traits\ConfiguresJobOptions;

class MakeSearchable implements ShouldQueue
{
    use ConfiguresJobOptions, Queueable, SerializesModels;

    /**
     * The models to be made searchable.
     *
     * @var \Heritage\Database\Eloquent\Collection
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
        $this->models = $models;

        $this->configureJob();
    }

    /**
     * Handle the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->models->isEmpty()) {
            return;
        }

        $this->models->first()->makeSearchableUsing($this->models)->first()->searchableUsing()->update($this->models);
    }
}
