<?php

namespace Tests\Feature;

use App\Http\Livewire\Customer\Locations;
use App\Http\Livewire\Customer\Modals\CreateCustomerModal;
use App\Http\Livewire\Customer\Modals\CreateLocationModal;
use App\Http\Livewire\Customer\Modals\EditCustomerModal;
use App\Http\Livewire\Customer\Modals\EditLocationModal;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerLivewireTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCloseCreateCustomerModal(): void
    {
        Livewire::test(CreateCustomerModal::class)
            ->call('closeModal')
            ->assertEmitted('closeModal',
                false,
                0);
    }

    public function testCreateCustomer(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(CreateCustomerModal::class)
            ->set('customer.name', 'Demo Customer 5886')
            ->set('customer.phone', '580-555-1234')
            ->set('customer.type', 1)
            ->set('customer.taxable', true)
            ->call('create');

        $customer = Customer::whereName('Demo Customer 5886')->first();
        $this->assertSame($customer->name, 'Demo Customer 5886');
        $this->assertSame($customer->phone, '580-555-1234');
        $this->assertSame($customer->type, 1);
        $this->assertTrue($customer->taxable);
    }

    public function testEditCustomer(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::whereName('Demo Customer 5886')->first();
        Livewire::test(EditCustomerModal::class, ['customerId' => $customer->id])
            ->set('customer.name', 'New Name 5886')
            ->set('customer.phone', '580-555-1500')
            ->set('customer.type', 2)
            ->set('customer.taxable', false)
            ->call('update');

        $customer->refresh();

        $this->assertSame($customer->name, 'New Name 5886');
        $this->assertSame($customer->phone, '580-555-1500');
        $this->assertSame($customer->type, 2);
        $this->assertFalse($customer->taxable);
    }

    public function testShowCustomer(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::whereName('New Name 5886')->first();
        $this->get('/customers/'.$customer->id)
            ->assertStatus(200)
            ->assertSeeLivewire('customer.show-customer');
    }

    public function testCreateLocation(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::whereName('New Name 5886')->first();
        Livewire::test(CreateLocationModal::class, ['customerId' => $customer->id])
            ->set('location.name', 'Test Location')
            ->set('location.address', '123 Main Street')
            ->set('location.address_2', 'Suite 1')
            ->set('location.city', 'Ponca City')
            ->set('location.state', 'OK')
            ->set('location.zip', '74601')
            ->set('location.phone', '580-555-1234')
            ->call('create');

        $location = CustomerLocation::whereCustomerId($customer->id)->first();
        $this->assertSame($location->name, 'Test Location');
        $this->assertSame($location->address, '123 Main Street');
        $this->assertSame($location->address_2, 'Suite 1');
        $this->assertSame($location->city, 'Ponca City');
        $this->assertSame($location->state, 'OK');
        $this->assertSame($location->zip, '74601');
        $this->assertSame($location->phone, '580-555-1234');
    }

    public function testEditLocation(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::whereName('New Name 5886')->first();
        $location = CustomerLocation::whereCustomerId($customer->id)->first();
        Livewire::test(EditLocationModal::class, ['locationId' => $location->id])
            ->set('location.name', 'Test Location 2')
            ->set('location.address', '123 Main Street 2')
            ->set('location.address_2', 'Suite 1 2')
            ->set('location.city', 'Ponca City 2')
            ->set('location.state', 'CO')
            ->set('location.zip', '74602')
            ->set('location.phone', '580-555-1235')
            ->call('update');

        $location = CustomerLocation::whereCustomerId($customer->id)->first();
        $this->assertSame($location->name, 'Test Location 2');
        $this->assertSame($location->address, '123 Main Street 2');
        $this->assertSame($location->address_2, 'Suite 1 2');
        $this->assertSame($location->city, 'Ponca City 2');
        $this->assertSame($location->state, 'CO');
        $this->assertSame($location->zip, '74602');
        $this->assertSame($location->phone, '580-555-1235');
    }

    public function testDeleteLocation(): void
    {
        $this->actingAs(User::factory()->create());
        $customer = Customer::whereName('New Name 5886')->first();
        $location = CustomerLocation::whereCustomerId($customer->id)->first();
        Livewire::test(Locations::class, ['customer' => $customer])
            ->set('delete_location_id', $location->id)
            ->call('confirmedDeleteLocation');
        $this->assertFalse($location->exists());
    }
}
