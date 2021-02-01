<?php

namespace App\Services\Socials\Content;

/**
 * Interface Formatter.
 */
interface Formatter
{
    /**
     * @param string $text
     * @param int $limit
     *
     * @return string
     */
    public function content(string $text, int $limit = 0): string;

    /**
     * @param string $text
     *
     * @return string
     */
    public function nextLine(string $text): string;

    /**
     * @param string $text
     *
     * @return string
     */
    public function divBlock(string $text): string;

    /**
     * @param string $text
     * @param string $url
     *
     * @return string
     */
    public function hrefLink(string $text, string $url): string;
}
