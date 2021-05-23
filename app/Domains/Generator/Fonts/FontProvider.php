<?php

namespace App\Domains\Generatior\Fonts;

/**
 * Interface FontProvider.
 */
abstract class FontProvider implements FontContract
{
    /**
     * @return string
     */
    public function getPublicPath(): string
    {
        return public_path($this->path);
    }
}
