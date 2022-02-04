<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavbarItem extends Component
{
    /**
     * メニューのリンク先
     * @var string
     */
    public $href;

    /**
     * アクティブ
     * @var
     */
    public $active=false;

    /**
     * Create a new component instance.
     *
     * @param string $href
     * @param bool $active
     */
    public function __construct(string $href, bool $active=false)
    {
        $this->href   = $href;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar-item');
    }
}
