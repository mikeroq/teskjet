<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use App\Traits\MyPagination;
use Illuminate\View\View;
use Livewire\Component;

class History extends Component
{
    use MyPagination;

    public Customer $customer;

    public function render(): View
    {
        return view('livewire.customer.history',[
            'actions' => $this->customer->activities()->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
