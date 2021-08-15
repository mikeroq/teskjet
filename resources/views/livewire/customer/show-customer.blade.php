<div x-data="{ tab: window.location.hash ? window.location.hash : '#overview' }" class="">
    <x-page-header :title="$customer->name" subtitle="Viewing Customer">
        <x-action-dropdown id="customer_action_dropdown">
            <button class="dropdown-item" wire:click='$emit("openModal", "customer.modals.edit-customer-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
                <i class="fas fa-edit mr-1 fa-fw"></i>
                Edit Customer
            </button>
            <button class="dropdown-item" wire:click='$emit("openModal", "customer.modals.create-location-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
                <i class="fas fa-location-arrow mr-1 fa-fw"></i>
                Add Location
            </button>
            <button class="dropdown-item">
                <i class="fas fa-times mr-1 fa-fw"></i>
                Delete Customer
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content mb-0 p-0 sticky-top sticky-offset">
        <ul class="nav nav-tabs nav-tabs-block" id="tabs" role="tablist">
            <x-tab-button id="overview" name="Overview"/>
            <x-tab-button id="addresses" name="Addresses"/>
            <x-tab-button id="contacts" name="Contacts"/>
            <x-tab-button id="tickets" name="Tickets"/>
            <x-tab-button id="devices" name="Devices"/>
            <x-tab-button id="licenses" name="Licenses"/>
            <x-tab-button id="notes" name="Notes"/>
            <x-tab-button id="history" name="History" class="ms-auto"/>
        </ul>
    </div>
    <div class="tab-content">
        <x-tab-pane id="overview">
            <div class="row g-0 flex-md-10-auto">
                <div class="col-md-4 col-lg-5 col-xl-3 order-md-1 bg-body-dark">
                    <div class="content">
                        <div class="d-md-none push">
                            <button type="button" class="btn btn-block btn-secondary" data-toggle="class-toggle" data-target="#side-content" data-class="d-none">
                                Customer Details
                            </button>
                        </div>
                        <div id="side-content" class="d-none d-md-block push">
                            <h2 class="h4 font-w400 mb-3">About</h2>
                            <table class="table table-striped table-borderless fs-sm">
                                <tbody>
                                <tr>
                                    <td style="width: 20%;">Created</td>
                                    <td class="text-end">{{ $customer->created_at->format(config('app.datetime_format')) }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Updated</td>
                                    <td class="text-end">{{ $customer->updated_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-7 col-xl-9 order-md-0">
                    <div class="content content-full">

                    </div>
                </div>
            </div>
        </x-tab-pane>
        <x-tab-pane id="addresses">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-vcenter">
                            <thead>
                            <tr>
                                <th>Location Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Phone</th>
                                <th class="text-end">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customer->locations as $location)
                                <tr>
                                    <td>@if($location->name) {{ $location->name }} @else {{ $customer->name }} @endif</td>
                                    <td>{{ $location->address }}@if($location->address_2), {{$location->address_2 }}@endif</td>
                                    <td>{{ $location->city }}</td>
                                    <td>{{ $location->state }} </td>
                                    <td>{{ $location->zip }}</td>
                                    <td>@if($location->phone) {{ $location->phone }} @else {{ $customer->phone }} @endif</td>
                                    <td class="text-end">
                                        @if($customer->default_address === $location->id)
                                            <button type="button" class="btn-block-option btn-block-option-disabled disabled" title="Primary address" disabled>
                                                <i class="fas fa-star"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn-block-option btn-block-faded" wire:click="setDefaultAddress({{ $location->id }})" title="Set as primary address">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        @endif
                                        @if($customer->shipping_address === $location->id)
                                            <button type="button" class="btn-block-option btn-block-option-disabled  disabled" title="Shipping address" disabled>
                                                <i class="fas fa-truck"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn-block-option btn-block-faded" wire:click="setShippingAddress({{ $location->id }})" title="Set as shipping address">
                                                <i class="fas fa-truck"></i>
                                            </button>
                                        @endif
                                        @if($customer->billing_address === $location->id)
                                            <button type="button" class="btn-block-option btn-block-option-disabled  disabled" title="Billing address" disabled>
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn-block-option btn-block-faded" wire:click="setBillingAddress({{ $location->id }})" title="Set as billing address">
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                        @endif
                                        <button type="button" class="btn-block-option" wire:click="$emit('openModal', 'customer.modals.edit-location-modal', {{ json_encode(['locationId' => $location->id], JSON_THROW_ON_ERROR) }})" title="Edit address">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" wire:click="triggerLocationDelete({{ $location->id }})" title="Delete address">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </x-tab-pane>
        <x-tab-pane id="contacts">
            <x-block><p>Contacts</p></x-block>
        </x-tab-pane>
        <x-tab-pane id="tickets">
            <x-block><p>Tickets</p></x-block>
        </x-tab-pane>
        <x-tab-pane id="devices">
            <x-block><p>Devices</p></x-block>
        </x-tab-pane>
        <x-tab-pane id="licenses">
            <x-block><p>Licenses</p></x-block>
        </x-tab-pane>
        <x-tab-pane id="notes">
            @comments(['model' => $customer])
        </x-tab-pane>
        <x-tab-pane id="history">
            <x-block>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Action</th>
                        <th>User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($customer->revisionHistory()->orderBy('created_at', 'desc')->get() as $history)
                        <tr>
                            <td>{{ $history->created_at->setTimezone(auth()->user()->timezone)->format('Y-m-d h:i a') }}</td>
                            @if ($history->key === 'created_at' && !$history->old_value)
                                <td>Created Customer</td>
                            @else
                                <td>{{ $history->fieldName() }} was changed from {{ $history->oldValue() }} to {{ $history->newValue() }}</td>
                            @endif
                            <td>{{ $history->userResponsible()->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-block>
        </x-tab-pane>
    </div>
</div>