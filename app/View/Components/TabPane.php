<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabPane extends Component
{
    public string $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function render(): View
    {
        return view('components.tab-pane');
    }
}
