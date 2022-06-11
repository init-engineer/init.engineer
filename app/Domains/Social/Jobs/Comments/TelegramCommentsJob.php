<?php

namespace App\Domains\Social\Jobs\Comments;

use App\Domains\Social\Models\Platform;
use App\Domains\Social\Models\PlatformCards;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class TelegramCommentsJob.
 */
class TelegramCommentsJob implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * @var Platform
     */
    protected $platform;

    /**
     * @var PlatformCards
     */
    protected $platformCards;

    /**
     * Create a new job instance.
     *
     * @param Platform $platform
     * @param PlatformCards $platformCards
     *
     * @return void
     */
    public function __construct(Platform $platform, PlatformCards $platformCards)
    {
        $this->platform = $platform;
        $this->platformCards = $platformCards;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
