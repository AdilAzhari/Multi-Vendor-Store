<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class nav extends Component
{
    public $items, $active;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = config('nav');
        $this->active = request()->routeIs('dashboard.*') ? 'active' : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $items = $this->items;
        $active = $this->active;
        return view('components.nav', compact('items', 'active'));
    }
}
