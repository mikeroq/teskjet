<?php

namespace App\Http\Livewire\Modals;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use LivewireUI\Modal\ModalComponent;

class CustomerCreateModal extends ModalComponent
{
    public string $name;
    public string $phone;
    public string $type;
    public string $taxable;

    public function create(): RedirectResponse
    {
        $validated = $this->validate([
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

        $customer = Customer::create($validated);

        $this->flash('success', 'Successful', [
            'position' =>  'center',
            'timer' =>  '1500',
            'toast' =>  false,
            'text' =>  'Added' . $customer->name,
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->closeModal();
        $this->reset();
        return redirect()->to(route('customers.show', $customer->id));
    }

    public function render(): View
    {
        return view('livewire.modals.customer-create-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Customer';
    }
}
