<?php

namespace App\Jobs\Social\MediaCards;

use App\Models\Social\Cards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Socials\MediaCards\PlurkPrimaryService;

/**
 * Class PlurkPrimaryPublish.
 */
class PlurkPrimaryPublish implements ShouldQueue
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
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(6);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(PlurkPrimaryService $service)
    {
        $service->publish($this->cards);
    }
}
