<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Http\Livewire\Traits\HasFormRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditCustomerModal extends ModalComponent
{
    use HasFormRequest;

    public Customer $customer;
    protected $formRequest = CustomerRequest::class;

    public static function bsModalTitle(): string
    {
        return 'Update Customer';
    }

    public function mount(int $customerId): void
    {
        $this->customer = Customer::findOrFail($customerId);
    }

    public function update(): void
    {
        $this->validate();
        $this->customer->save();
        if ($this->customer->wasChanged()) {
            self::alert('success', 'Customer updated!');
            $this->emit('customerShowRefresh');
            $this->dispatchBrowserEvent('update-title', ['title' => $this->customer->name.' - Viewing Customer - '.config('app.name')]);
            $this->forceClose()->closeModal();
        } else {
            self::alertPreset('toast', 'info', 'You did not modify any fields!');
        }
    }

    public function render(): View
    {
        return view('livewire.customer.modals.edit-customer-modal');
    }
}
