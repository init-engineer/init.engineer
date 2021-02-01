<?php

namespace App\Services\Socials\Content;

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
     * @var string
     */
    protected string $type = 'text';

    /**
     * @var array
     */
    protected array $footerOption = [];

    /**
     * @var Formatter
     */
    protected Formatter $printer;

    /**
     * ContentFluent constructor.
     *
     * @param Formatter $printer
     */
    public function __construct(Formatter $printer)
    {
        $this->printer = $printer;
    }

    /**
     * @param Formatter $printer
     *
     * @return $this
     */
    public function formatter(Formatter $printer)
    {
        $this->printer = $printer;

        return $this;
    }

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
     * @param string $type
     *
     * @return $this
     */
    public function body(string $content, int $limit = 0, string $type = 'text')
    {
        $this->content = $content;
        $this->limit = $limit;
        $this->type = $type;

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
        $response = $this->printer->divBlock("#" . app_name() . base_convert($this->id, 10, 36));
        $response = $this->printer->nextLine($response);
        $response = $response . $this->printer->content($this->content, $this->limit);
        $response = $this->printer->nextLine($response);

        if (isset($this->footerOption['review']) && $this->footerOption['review'])
            $response = $this->printer->hrefLink("🗳️ [群眾審核] ", route('frontend.social.cards.review'));
        if (isset($this->footerOption['github']) && $this->footerOption['github'])
            $response = $this->printer->hrefLink("👉 [GitHub Repo] ", "https://github.com/init-engineer/init.engineer");
        if (isset($this->footerOption['publish']) && $this->footerOption['publish'])
            $response = $this->printer->hrefLink("📢 [匿名發文] ", route('frontend.social.cards.create'));
        if (isset($this->footerOption['show']) && $this->footerOption['show'])
            $response = $this->printer->hrefLink("🥙 [全平台留言] ", route('frontend.social.cards.show', ['id' => $this->id]));

        return $response;
    }
}
