<?php

namespace App\Http\Transformers\Traits;

use League\Fractal\TransformerAbstract;

/**
 * Class DateTransformer.
 */
class DateTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param $date
     *
     * @return array
     */
    public static function transform($date = null)
    {
        return [
            'diff' => isset($date) ? $date->diffForHumans() : null,
            'datetime' => isset($date) ? timezone()->convertToLocal($date, 'Y-m-d H:i:s', 'Asia/Taipei') : null,
            'timestamp' => isset($date) ? $date->timestamp : null,
        ];
    }
}
