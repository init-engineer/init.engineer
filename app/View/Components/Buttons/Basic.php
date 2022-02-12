<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class Basic extends Component
{
    /**
     * 按鈕大小
     *
     * 可以是 `M`（預設）或 `L`。
     *
     * FIXME: refactor with enum when our IDE supports it
     *
     * @var string
     */
    public string $size;

    /**
     * Create a new component instance.
     *
     * @param string $size 按鈕大小。可以是 `M`（預設）或 `L`。
     * @return void
     */
    public function __construct(string $size = "M")
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.basic');
    }
}
