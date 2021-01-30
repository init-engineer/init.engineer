<?php

namespace App\Jobs\Social\MediaCards;

use App\Models\Social\Cards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Socials\MediaCards\TumblrPrimaryService;

/**
 * Class TumblrPrimaryPublish.
 */
class TumblrPrimaryPublish implements ShouldQueue
{
    use Queueable,
        Dispatchable,
        SerializesModels,
        InteractsWithQueue;

    /**
     * @var Cards
     */
    protected $cards;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Cards $cards)
    {
        $this->cards = $cards;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TumblrPrimaryService $service)
    {
        $service->publish($this->cards);
    }
}
