<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public string $id;
    public string $buttonName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $buttonName = 'Actions')
    {
        $this->id = $id;
        $this->buttonName = $buttonName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|
     */
    public function render(): View
    {
        return view('components.action-dropdown');
    }
}
