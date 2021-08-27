<?php

namespace App\Http\Livewire\Customer\Modals;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\ShortNumberInfo;
use LivewireUI\Modal\ModalComponent;

class CreateCustomerModal extends ModalComponent
{
    public $customer;
    protected array $rules = [
        'customer.name' => 'required',
        'customer.phone' => 'required|phone:US|unique:customers,phone',
        'customer.type' => 'required',
        'customer.taxable' => 'boolean',
    ];

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
