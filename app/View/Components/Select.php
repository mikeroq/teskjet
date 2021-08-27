<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $label;
    public string $id;
    public string $error;

    public function __construct($id = '', $label = '')
    {
        $this->label = $label;
        $this->id = $id;
        $this->error = '';
    }

    public function render(): View
    {
        return view('components.select');
    }
}
