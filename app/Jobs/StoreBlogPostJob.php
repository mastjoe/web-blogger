<?php

namespace App\Jobs;

use Throwable;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class StoreBlogPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * defines the blog post data passed
     *
     * @var array
     */
    public $blogPostData;

    /**
	 * The maximum number of unhandled exceptions to allow before failing.
	 *
	 * @var int
	 */
	public $maxExceptions = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $blogPostData)
    {
        //
        $this->blogPostData = $blogPostData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Post::create($this->blogPostData);
    }

    /**
     * defines the job retry duration
     *
     * @return \Carbon\Carbon
     */
    public function retryUntil()
	{
		return now()->addMinutes(5);
	}

    /**
     * handles job exception
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception)
	{
		Log::error($exception->getMessage(), $exception->getTrace());
	}
}
