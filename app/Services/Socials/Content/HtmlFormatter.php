<?php

namespace App\Services\Socials\Content;

use Illuminate\Support\Str;

/**
 * Class HtmlFormatter.
 */
class HtmlFormatter implements Formatter
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

        return nl2br($content);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function nextLine(string $text): string
    {
        return $text . "<br/><hr/><br/>";
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function divBlock(string $text): string
    {
        return sprintf("<div><p>%s</p></div>", $text);
    }

    /**
     * @param string $text
     * @param string $url
     *
     * @return string
     */
    public function hrefLink(string $text, string $url): string
    {
        return sprintf("<a href='%'>%s</a>", $url, $text);
    }
}
