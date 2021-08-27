<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Block extends Component
{
    public string $title;
    public $options;
    public Collection $contentClass;
    public $footer;

    public function __construct($title = '', $contentClass = '')
    {
        $this->title = $title;
        $this->contentClass = new Collection();
        $this->contentClass->add('block-content');
        $this->contentClass->add($contentClass);
    }

    public function render(): View
    {
        return view('components.block');
    }
}
