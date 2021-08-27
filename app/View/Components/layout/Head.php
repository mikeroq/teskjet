<?php

namespace App\View\Components\layout;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Head extends Component
{
    public string $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function render(): View
    {
        return view('components.layout.head');
    }
}
