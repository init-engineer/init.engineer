<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class Item extends Component
{
    /**
     * The alert type.
     *
     * @var boolean
     */
    public $active;

    /**
     * The link of this item.
     *
     * @var string
     */
    public $href;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $active = false, string $href = '#')
    {
        $this->active = $active;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar.item');
    }
}
