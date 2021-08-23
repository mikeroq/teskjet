<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use LivewireUI\Modal\ModalComponent;

class CreateCustomerModal extends ModalComponent
{
    public string $name = '';
    public string $phone = '';
    public string $type = '';
    public int $taxable = 0;

    public function create()
    {
        $validated = $this->validate([
            'name' => 'required',
            'phone' => 'required|phone:AUTO,US|unique:customers,phone',
            'type' => 'required',
            'taxable' => 'numeric|nullable'
        ],
        [
            'name.required' => 'The name cannot be empty.',
            'phone.required' => 'The phone cannot be empty.',
            'phone.phone' => 'Must be a valid North American phone number.',
            'type.required' => 'Please choose a type.',
        ]);

        $customer = Customer::create($validated);

        self::flash('success', 'Successful', [
            'position' =>  'center',
            'timer' =>  '1500',
            'toast' =>  false,
            'text' =>  'Added' . $customer->name,
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->forceClose()->closeModal();
        $this->reset();
        return redirect()->to(route('customers.show', $customer->id));
    }

    public function render(): View
    {
        return view('livewire.customer.modals.create-customer-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Add Customer';
    }
}
