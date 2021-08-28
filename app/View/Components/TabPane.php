<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TabPane extends Component
{
    public string $id;
    public bool $wrapper;

    public function __construct($id, $wrapper = true)
    {
        $this->id = $id;
        $this->wrapper = $wrapper;
    }

    public function render(): View
    {
        return view('components.tab-pane');
    }
}
