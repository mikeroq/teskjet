<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionDropdown extends Component
{

    public $id;
    public $buttonName;

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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.action-dropdown');
    }
}
