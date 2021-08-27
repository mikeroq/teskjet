<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
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

    public function render()
    {
        return view('components.checkbox');
    }
}
