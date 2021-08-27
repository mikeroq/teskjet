<?php

namespace App\Http\Livewire\Admin;

use App\Models\Navigation;
use App\Models\NavigationChild;
use App\Models\NavigationType;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class NavigationTable extends Component
{
    public NavigationType $type;
    public string $delete_id_parent;
    public string $delete_id_child;

    protected $listeners = [
        'navTab' => 'changeType',
        'refreshNavigationTable' => '$refresh',
        'confirmedDeleteNavigation',
        'confirmedDeleteNavigationChild',
        'cancelledDelete',
    ];

    public function mount() :void
    {
        $this->type = NavigationType::findOrFail(1);
    }

    public function changeType($type) :void
    {
        $this->type = NavigationType::findOrFail($type);
    }

    public function render(): View
    {
        $type = $this->type;
        $parent_pages = Navigation::with('children')->where('navigation_type_id', $this->type->id)->orderBy('order_column')->get();

        return view('livewire.admin.navigation-table')->with(compact('type', 'parent_pages'));
    }

    public function orderParent(Navigation $navigation, $direction): void
    {
        if ($direction === 'up') {
            $navigation->moveOrderUp();
        } elseif ($direction === 'down') {
            $navigation->moveOrderDown();
        }
        $this->emit('refreshNavigationTable');
    }

    public function orderChild(NavigationChild $navigationChild, $direction): void
    {
        if ($direction === 'up') {
            $navigationChild->moveOrderUp();
        } elseif ($direction === 'down') {
            $navigationChild->moveOrderDown();
        }
        $this->emit('refreshNavigationTable');
    }

    public function triggerNavigationDelete($delete_id): void
    {
        $this->delete_id_parent = $delete_id;
        self::confirm('Are you sure you want to delete?', [
            'onConfirmed' => 'confirmedDeleteNavigation',
            'onCancelled' => 'cancelledDelete',
        ]);
    }

    public function triggerNavigationChildDelete($delete_id): void
    {
        $this->delete_id_child = $delete_id;
        self::confirm('Are you sure you want to delete?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmedDeleteNavigationChild',
            'onCancelled' => 'cancelledDelete',
        ]);
    }

    public function confirmedDeleteNavigation(): void
    {
        Navigation::findorFail($this->delete_id_parent)->delete();

        self::alert(
            'success',
            'Navigation deleted!'
        );
    }

    public function confirmedDeleteNavigationChild(): void
    {
        NavigationChild::findorFail($this->delete_id_child)->delete();

        self::alert(
            'success',
            'Navigation deleted!'
        );
    }

    public function cancelledDelete(): void
    {
        // Example code inside cancelled callback

        self::alert('info', 'Navigation was not deleted');
    }
}
