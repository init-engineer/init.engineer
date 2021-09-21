<?php

namespace App\Domains\Social\Services\Content;

/**
 * Class ContentFluent.
 */
class ContentFluent
{
    /**
     * @var array $content = []
     */
    protected array $content = [];

    /**
     * @return ContentFluent
     */
    public function reset(): ContentFluent
    {
        $this->content = [];

        return $this;
    }

    /**
     * @param int $id
     *
     * @return ContentFluent
     */
    public function header(int $id): ContentFluent
    {
        array_push($this->content, '#' . appName() . base_convert($id, 10, 36));

        return $this;
    }

    /**
     * @param string $body
     *
     * @return ContentFluent
     */
    public function body(string $body): ContentFluent
    {
        array_push($this->content, $body);

        return $this;
    }

    /**
     * @param string $footer
     *
     * @return ContentFluent
     */
    public function footer(string $footer): ContentFluent
    {
        array_push($this->content, $footer);

        return $this;
    }

    /**
     * @param string $src
     *
     * @return ContentFluent
     */
    public function image(string $src): ContentFluent
    {
        array_push($this->content, $src);

        return $this;
    }

    /**
     * @return ContentFluent
     */
    public function hr(): ContentFluent
    {
        array_push($this->content, '----------');

        return $this;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function build(string $type = 'text'): string
    {
        $result = '';
        foreach ($this->content as $value) {
            switch ($type) {
                case 'text':
                    $result = $result . $value . "\n";
                    break;

                case 'html':
                    $result = $result . '<div>' . nl2br($value) . '</div><br><hr><br>';
                    break;
            }
        }

        return $result;
    }
}
