<?php

namespace App\Http\Transformers;

/**
 * Interface TransformerContract.
 */
interface TransformerContract
{
    public function transform($data);

    public function toCsv($data);
}
