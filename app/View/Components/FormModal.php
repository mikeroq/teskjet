<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormModal extends Component
{
    public $type;
    public $slug;
    public $title;
    public $icon;
    public $btn;
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-modal');
    }
}
