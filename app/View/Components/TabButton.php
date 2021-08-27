<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabButton extends Component
{
    public string $name;
    public string $id;

    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function render(): View
    {
        return view('components.tab-button');
    }
}
