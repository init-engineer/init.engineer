<?php

namespace App\Domains\Social\Events\Cards;

use App\Domains\Social\Models\Cards;
use Illuminate\Queue\SerializesModels;

/**
 * Class PictureCreated.
 */
class PictureCreated
{
    use SerializesModels;

    /**
     * @var Cards
     */
    public $cards;

    /**
     * @param Cards $cards
     */
    public function __construct(Cards $cards)
    {
        $this->cards = $cards;
    }
}
