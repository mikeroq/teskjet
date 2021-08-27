<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public string $label;
    public string $id;

    public function __construct($id = '', $label = '')
    {
        $this->label = $label;
        $this->id = $id;
    }

    public function render(): View
    {
        return view('components.form-group');
    }
}
