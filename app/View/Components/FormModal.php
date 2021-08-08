<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class FormModal extends Component
{
    public string $type;
    public string $slug;
    public string $title;
    public string $icon;
    public string $btn;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $slug, $title, $icon = '', $btn = '')
    {
        $this->title = $title;
        $this->type = $type;
        $this->slug = $slug;
        $this->icon = $icon;
        $this->btn = $btn;

        switch ($this->type) {
            case "create":
                $this->icon = "fas fa-plus";
                $this->btn = "Add";
            break;
            case "edit":
                $this->icon = "fas fa-pencil-alt";
                $this->btn = "Update";
            break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form-modal');
    }
}
