<?php
namespace App\Traits;

use Livewire\WithPagination;

trait MyPagination
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public function setPage($page): void
    {
        $this->page = $page;
        $this->emit('gotoTop');
    }
}