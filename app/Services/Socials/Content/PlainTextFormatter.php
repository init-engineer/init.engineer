<?php

namespace App\Services\Socials\Content;

use Illuminate\Support\Str;

/**
 * Class PlainTextFormatter.
 */
class PlainTextFormatter implements Formatter
{
    /**
     * @param string $text
     * @param int $limit
     *
     * @return string
     */
    public function content(string $text, int $limit = 0): string
    {
        $content = ($limit != 0) ? Str::limit($text, $limit, '...') : $text;

        return $content;
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function nextLine(string $text): string
    {
        return $text . "\n\r----------\n\r";
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function divBlock(string $text): string
    {
        return $text;
    }

    /**
     * @param string $text
     * @param string $url
     *
     * @return string
     */
    public function hrefLink(string $text, string $url): string
    {
        return sprintf("%s %s\n\r", $text, $url);
    }
}
