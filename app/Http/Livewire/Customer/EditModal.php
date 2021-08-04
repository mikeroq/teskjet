<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;


class EditModal extends ModalComponent
{
    public $name;
    public $phone;
    public $type;
    public $taxable;

    public Customer $customer;



    public function mount(int $customerId)
    {
        $this->customer = Customer::find($customerId);

        $this->name = $this->customer->name;
        $this->phone = $this->customer->getRawOriginal('phone');
        $this->type = $this->customer->getRawOriginal('type');
        $this->taxable = $this->customer->taxable;
    }

    public function update()
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

        $this->customer->name = $this->name;
        $this->customer->phone = $this->phone;
        $this->customer->type = $this->type;
        $this->customer->taxable = $this->taxable;
        $this->customer->save();

        $this->alert('success', 'Edit Successful', [
            'position' =>  'center',
            'timer' =>  '2000',
            'toast' =>  false,
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);

        $this->emit('customerShowRefresh');
        $this->closeModal();

        // return redirect()->to(route('customers.show', $this->customer->id));
    }

    public function render()
    {
        return view('livewire.customer.edit-modal');
    }

    public static function bsModalTitle(): string
    {
        return 'Editing Customer';
    }
}

