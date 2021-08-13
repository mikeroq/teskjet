<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Block extends Component
{
    public string $title;
    public $options;
    public Collection $contentClass;
    public $footer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '', $contentClass = '')
    {
        $this->title = $title;
        $this->contentClass = new Collection();
        $this->contentClass->add('block-content');
        $this->contentClass->add($contentClass);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.block');
    }
}
