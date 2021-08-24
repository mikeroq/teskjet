<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;


class EditCustomerModal extends ModalComponent
{
    public Customer $customer;

    protected array $rules = [
        'name' => 'required',
        'phone' => 'required|phone:AUTO,US',
        'type' => 'required',
        'taxable' => 'nullable'
    ];

    protected array $messages = [
        'name.required' => 'The name cannot be empty.',
        'phone.required' => 'The phone cannot be empty.',
        'phone.phone' => 'Must be a valid North American phone number.',
        'type.required' => 'Please choose a type.',
    ];

    public static function bsModalTitle(): string
    {
        return 'Editing Customer';
    }

    public function mount(int $customerId): void
    {
        $this->customer = Customer::findOrFail($customerId);

        $this->fill([
            'name' => $this->customer->name,
            'phone' => $this->customer->phone,
            'type' => $this->customer->getRawOriginal('type'),
            'taxable' => $this->customer->taxable,
        ]);

    }

    public function update(): void
    {
        $validated = $this->validate();

        if ($this->taxable !== 1) {
            $validated['taxable'] = 0;
        }
        $this->customer->update($validated);
        $this->customer->save();

        if ($this->customer->wasChanged()) {
            self::alert('success', 'Edit Successful', [
                'position' =>  'center',
                'timer' =>  '2000',
                'toast' =>  false,
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
            ]);

            $this->emit('customerShowRefresh');
            $this->dispatchBrowserEvent('update-title', ['title' => $this->customer->name . ' - Viewing Customer - ' . config('app.name')]);
            $this->forceClose()->closeModal();
        } else {
            self::alert('info', 'Notice', [
                'position' =>  'top-end',
                'text' => 'You did not modify any fields. Customer was not modified.',
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
}

