<?php

namespace Torann\TaggableFileCache\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FlushTagFromFileCacheJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $tagIds;
    protected $driver;

    /**
     * Create a new job instance.
     *
     * @param mixed  $ids
     * @param string $driver
     */
    public function __construct($ids, $driver = 'tagged_file')
    {
        $this->tagIds = is_array($ids) ? $ids : [$ids];
        $this->driver = $driver;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->tagIds as $id) {
            app('cache')->driver($this->driver)->flushOldTag($id);
        }
    }
}
