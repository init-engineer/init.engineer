<?php

namespace App\Domains\Generatior\Fonts;

/**
 * Interface FontContract.
 */
interface FontContract
{
    /**
     * @var string
     */
    protected string $path;

    /**
     * @var float
     */
    protected float $length;

    /**
     * @return string
     */
    public function getPublicPath(): string;
}
