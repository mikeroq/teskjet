<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormGroup extends Component
{
    public string $label;
    public string $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = '', $label = '')
    {
        $this->label = $label;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form-group');
    }
}
