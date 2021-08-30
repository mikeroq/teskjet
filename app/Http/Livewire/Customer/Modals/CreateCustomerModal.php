<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Http\Livewire\Traits\HasFormRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateCustomerModal extends ModalComponent
{
    use HasFormRequest;

    public $customer;
    protected $formRequest = CustomerRequest::class;

    public function mount(): Void
    {
        $this->customer = new Customer;
        $this->customer->taxable = false;
    }

    public function create()
    {
        $this->validate();
        $this->customer->save();
        self::flash('success', 'Successful', [
            'text' =>  'Added '.$this->customer->name.'!',
        ]);
        $this->forceClose()->closeModal();

        return redirect()->to(route('customers.show', $this->customer->id));
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
