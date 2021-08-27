<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public string $id;
    public string $type;
    public string $error;
    public string $label;
    public string $wrapper;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'text', $id = '', $label = '', $wrapper = 'true')
    {
        $this->type = $type;
        $this->id = $id;
        $this->error = '';
        $this->label = $label;
        $this->wrapper = $wrapper;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.input');
    }
}
