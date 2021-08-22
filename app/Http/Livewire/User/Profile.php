<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';
    public User $user;

    public function render()
    {
        return view('livewire.user.profile', [
            'actions' => $this->user->actions()->orderBy('created_at', 'desc')->paginate(10 )
        ]);
    }
}
