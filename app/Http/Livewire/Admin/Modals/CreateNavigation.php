<?php /** @noinspection AdditionOperationOnArraysInspection */

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Navigation;
use App\Models\NavigationChild;
use App\Models\NavigationType;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class CreateNavigation extends ModalComponent
{

    public string $title = '';
    public string $icon = '';
    public string $url = '';
    public string $user_level = '0';
    public string $parent = '';
    public string $parent_title = '';
    public string $navigation_type_id = '';
    public string $navigation_type_name = '';
    public int $is_hidden = 0;

    public function mount($type, $parent): void
    {
        Log::debug($type);
        $nav = NavigationType::findOrFail($type);
        Log::debug($nav);
        $this->navigation_type_id = $nav->id;
        $this->navigation_type_name = $nav->name;

        if ($parent === '0') {
            $this->parent = $parent;
        } else{
            $parent_model = Navigation::findOrFail($parent);
            $this->parent = $parent_model->id;
            $this->parent_title = $parent_model->title;
        }
    }

    public function render(): View
    {
        return view('livewire.admin.modals.create-navigation');
    }

    public function create(): void
    {
        $validated = $this->validate([
            'title' => 'required',
            'icon' => 'nullable',
            'url' => 'required',
            'user_level' => 'required',
            'is_hidden' => 'numeric|nullable'
        ]);

        if ($this->parent === '0') {
            $array = [
                'navigation_type_id' => $this->navigation_type_id
            ];
            $insert = $validated + $array;
            Navigation::create($insert);
        } else {
            $array = [
                'navigation_id' => $this->parent
            ];
            $insert = $validated + $array;
            NavigationChild::create($insert);
        }

        $this->reset([
            'title',
            'icon',
            'url',
            'user_level',
            'is_hidden'
        ]);
        $this->forceClose()->closeModalWithEvents(['refreshNavigationTable']);
        self::alert('success', 'Added Navigation', [
            'timer' =>  '2000'
        ]);
    }

    public static function bsModalTitle(): string
    {
        return 'Add Navigation';
    }
}
