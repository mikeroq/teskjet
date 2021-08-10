<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;


class EditCustomerModal extends ModalComponent
{
    public string $name;
    public string $phone;
    public string $type;
    public int $taxable;

    public Customer $customer;



    public function mount(int $customerId): void
    {
        $this->customer = Customer::findOrFail($customerId);

        $this->name = $this->customer->name;
        $this->phone = $this->customer->phone;
        $this->type = $this->customer->getRawOriginal('type');
        $this->taxable = $this->customer->taxable;
    }

    public function update(): void
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required|phone:AUTO,US',
            'type' => 'required',
            'taxable' => 'nullable'
        ],
        [
            'name.required' => 'The name cannot be empty.',
            'phone.required' => 'The phone cannot be empty.',
            'phone.phone' => 'Must be a valid North American phone number.',
            'type.required' => 'Please choose a type.',
        ]);
        if ($this->taxable !== 1) {
            $this->taxable = 0;
        }
        $this->customer->name = $this->name;
        $this->customer->phone = $this->phone;
        $this->customer->type = $this->type;
        $this->customer->taxable = $this->taxable;
        $this->customer->save();

        if ($this->customer->wasChanged()) {
            $this->alert('success', 'Edit Successful', [
                'position' =>  'center',
                'timer' =>  '2000',
                'toast' =>  false,
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->emit('customerShowRefresh');
            $this->dispatchBrowserEvent('update-title', ['title' => $this->customer->name . ' - Viewing Customer - ' . config('app.name')]);
            $this->closeModal();
        } else {
            $this->alert('info', 'Notice', [
                'position' =>  'top-end',
                'text' => 'You did not modify any fields. Nothing was changed.',
                'toast' =>  true,
                'timer' => '3000',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);
        }
    }

    public function render(): View
    {
        return view('livewire.customer.modals.edit-customer-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Editing Customer';
    }
}

