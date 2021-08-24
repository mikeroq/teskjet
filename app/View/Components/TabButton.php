<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabButton extends Component
{
    public string $name;
    public string $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.tab-button');
    }
}
