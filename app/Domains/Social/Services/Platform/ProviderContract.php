<?php

namespace App\Domains\Social\Services\Platform;

use App\Domains\Social\Models\Cards;

/**
 * Interface ProviderContract.
 */
interface ProviderContract
{
    public function publish(Cards $cards);

    public function deleted(Cards $cards);
}
