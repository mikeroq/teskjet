<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public string $id;
    public string $error;
    public string $label;
    public string $wrapper;

    public function __construct($id = '', $label = '', $wrapper = 'true')
    {
        $this->id = $id;
        $this->error = '';
        $this->label = $label;
        $this->wrapper = $wrapper;
    }

    public function render()
    {
        return view('components.text-area');
    }
}
