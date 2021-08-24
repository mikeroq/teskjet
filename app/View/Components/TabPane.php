<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabPane extends Component
{
    public string $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.tab-pane');
    }
}
