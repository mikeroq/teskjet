<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public string $title;
    public string $subtitle;

    public function __construct(string $title, string $subtitle = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public function render(): View
    {
        return view('components.page-header');
    }
}
