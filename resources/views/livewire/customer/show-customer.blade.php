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
    <div class="content tab-content">
        <x-tab-pane id="overview">
            <div class="block block-rounded">
                <div class="block-content text-center">
                    <div class="py-4">
                        <h1 class="mb-0">
                            <span>{{ $customer->name }}</span>
                        </h1>
                        <p class="fw-medium text-muted">{{ $customer->phone }}</p>
                    </div>
                </div>
                <div class="block-content bg-body-light text-center">
                    <div class="row items-push text-uppercase text-muted">
                        <div class="col-6 col-md-4">
                            <div class="fw-semibold text-dark mb-1">Customer Type</div>
                            {{ $customer->type }}
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="fw-semibold text-dark mb-1">Taxable Status</div>
                            {{ $customer->displayable_taxable }}
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="fw-semibold text-dark mb-1">Created</div>
                            {{ $customer->created_at->format('Y-m-d h:i a') }}
                        </div>
                    </div>
                </div>
            </div>
        </x-tab-pane>
        <x-tab-pane id="addresses">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        @foreach($customer->locations as $location)
                            <div class="col-lg-6">
                                <div class="block block-rounded block-bordered">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Address</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" wire:click="$emit('openModal', 'customer.modals.edit-location-modal', {{ json_encode(['locationId' => $location->id], JSON_THROW_ON_ERROR) }})">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn-block-option" wire:click="triggerLocationDelete({{ $location->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @if($customer->default_address !== $location->id)
                                            <button type="button" class="btn-block-option" wire:click="setDefaultAddress({{ $location->id }})">
                                                <i class="fas fa-star"></i>
                                            </button>
                                            @endif
                                            @if($customer->shipping_address !== $location->id)
                                                <button type="button" class="btn-block-option" wire:click="setShippingAddress({{ $location->id }})">
                                                    <i class="fas fa-truck"></i>
                                                </button>
                                            @endif
                                            @if($customer->billing_address !== $location->id)
                                                <button type="button" class="btn-block-option" wire:click="setBillingAddress({{ $location->id }})">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <address class="fs-sm">
                                            @if($location->name) {{ $location->name }}<br> @endif
                                            {{ $location->address }}<br>
                                            @if($location->address_2) {{ $location->address_2 }}<br> @endif
                                            {{ $location->city }}, {{ $location->state }} {{ $location->zip }}<br>
                                            {{ $location->phone }}
                                            @if($customer->default_address === $location->id)
                                            <br><b>Default Address</b>
                                            @endif
                                            @if($customer->shipping_address === $location->id)
                                            <br><b>Shipping Address</b>
                                            @endif
                                            @if($customer->billing_address === $location->id)
                                            <br><b>Billing Address</b>
                                            @endif
                                        </address>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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