<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public string $label;
    public string $id;
    public string $error;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = '', $label = '')
    {
        $this->label = $label;
        $this->id = $id;
        $this->error = '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
