<?php

namespace App\Domains\Social\Models\Traits\Attribute;

use Illuminate\Support\Str;

/**
 * Trait CardsAttribute.
 */
trait CardsAttribute
{
    /**
     * @param int $limit = 0
     *
     * @return string
     */
    public function getContent(int $limit = 0): string
    {
        if ($limit != 0) {
            return Str::limit($this->content, $limit, ' ...');
        }

        return $this->content;
    }
}
