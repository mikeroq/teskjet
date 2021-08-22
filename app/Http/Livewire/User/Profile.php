<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Traits\MyPagination;
use Livewire\Component;

class Profile extends Component
{
    use MyPagination;

    protected string $paginationTheme = 'bootstrap';
    public User $user;

    public function render()
    {
        return view('livewire.user.profile', [
            'actions' => $this->user->actions()
                ->orderBy('created_at', 'desc')
                ->paginate(5 )
        ]);
    }
}
