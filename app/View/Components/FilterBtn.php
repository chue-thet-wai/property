<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterBtn extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $resetRoute;

    public function __construct($resetRoute)
    {
        $this->resetRoute = $resetRoute;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.filter-btn');
    }
}
