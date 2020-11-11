<?php

namespace App\Services\SocialContent;

/**
 * Class ContentFluent.
 */
class ContentFluent
{
    /**
     * @var int
     */
    protected int $id = 0;

    /**
     * @var string
     */
    protected string $content = 'Undefined';

    /**
     * @var int
     */
    protected int $limit = 0;

    /**
     * @var array
     */
    protected array $footerOption = [];

    /**
     * @param int $id
     *
     * @return $this
     */
    public function header(int $id = 0)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $content
     * @param int    $limit
     *
     * @return $this
     */
    public function body(string $content, int $limit = 0)
    {
        $this->content = $content;
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param array $option = []
     *
     * @return $this
     */
    public function footer(array $option = [])
    {
        $this->footerOption = $option;

        return $this;
    }

    /**
     * @return string
     */
    public function get(): string
    {
        $response = "#" . app_name() . base_convert($this->id, 10, 36) . "\n\r----------\n\r";
        $content = ($this->limit != 0 && mb_strlen($this->content, 'utf-8') > $this->limit) ? mb_substr($this->content, 0, $this->limit, 'utf-8') . ' ...' : $this->content;
        $response = $response . $content;

        if (isset($this->footerOption['review']) && $this->footerOption['review']) $response = $response . "🗳️ [群眾審核] " . route('frontend.social.cards.review') . "\n\r";
        if (isset($this->footerOption['github']) && $this->footerOption['github']) $response = $response . "👉 [GitHub Repo] https://github.com/init-engineer/init.engineer" . "\n\r";
        if (isset($this->footerOption['publish']) && $this->footerOption['publish']) $response = $response . "📢 [匿名發文] " . route('frontend.social.cards.create') . "\n\r";
        if (isset($this->footerOption['show']) && $this->footerOption['show']) $response = $response . "🥙 [全平台留言] " . route('frontend.social.cards.show', ['id' => $this->id]) . "\n\r";

        return $response;
    }
}
