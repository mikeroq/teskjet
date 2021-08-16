<?php /** @noinspection PhpFieldAssignmentTypeMismatchInspection */

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Navigation;
use App\Models\NavigationChild;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditNavigationModal extends ModalComponent
{
    public string $title;
    public mixed $icon;
    public string $url;
    public string $user_level;
    public string $type;
    public string $is_hidden;

    public Navigation|NavigationChild $navigation;

    public function mount($type, $id): void
    {
        if ($type === "parent") {
            $this->navigation = Navigation::findOrFail($id);
        } else {
            $this->navigation = NavigationChild::findOrFail($id);
        }
        $this->type = $type;
        $this->title = $this->navigation->title;
        $this->icon = $this->navigation->icon;
        $this->url = $this->navigation->url;
        $this->user_level = $this->navigation->user_level;
        $this->is_hidden = $this->navigation->is_hidden;

    }

    public function update(): void
    {
        $validated = $this->validate([
            'title' => 'required',
            'icon' => 'nullable',
            'url' => 'required',
            'is_hidden' => 'nullable|numeric',
            'user_level' => 'required'
        ]);

        $this->navigation->update($validated);
        $this->navigation->save();

        $this->forceClose()->closeModal();

        $this->emit('refreshNavigationTable');
        $this->alert('success', 'Edited Navigation', [
            'timer' =>  '2000'
        ]);

    }

    public function render(): View
    {
        return view('livewire.admin.modals.edit-navigation-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Editing Navigation';
    }
}
