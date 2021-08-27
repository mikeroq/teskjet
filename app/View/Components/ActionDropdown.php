<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public string $id;
    public string $buttonName;

    public function __construct($id, $buttonName = 'Actions')
    {
        $this->id = $id;
        $this->buttonName = $buttonName;
    }

    public function render(): View
    {
        return view('components.action-dropdown');
    }
}
