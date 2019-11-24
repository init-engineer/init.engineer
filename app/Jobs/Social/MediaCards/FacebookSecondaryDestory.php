<?php

namespace App\Jobs\Social\MediaCards;

use App\Models\Auth\User;
use App\Models\Social\Cards;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Socials\MediaCards\FacebookSecondaryService;

/**
 * Class FacebookSecondaryDestory.
 */
class FacebookSecondaryDestory implements ShouldQueue
{
    use Queueable,
        Dispatchable,
        SerializesModels,
        InteractsWithQueue;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Cards
     */
    protected $cards;

    /**
     * @var array
     */
    protected $options;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Cards $cards, array $options)
    {
        $this->user = $user;
        $this->cards = $cards;
        $this->options = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(FacebookSecondaryService $service)
    {
        $service->destory($this->user, $this->cards, $this->options);
    }
}
