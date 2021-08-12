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
            <li class="nav-item">
                <button :class="{ 'active': tab === '#overview' }" class="nav-link" role="tab" aria-controls="overview" x-on:click.prevent="tab='#overview'; window.location.hash = '#overview' " id="overview-tab">
                    Overview
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#addresses' }" class="nav-link" role="tab" aria-controls="addresses" x-on:click.prevent="tab='#addresses'; window.location.hash = '#addresses'" id="addresses-tab">
                    Addresses
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#contacts' }" class="nav-link" role="tab" aria-controls="contacts" x-on:click.prevent="tab='#contacts'; window.location.hash = '#contacts'" id="contacts-tab">
                    Contacts
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#tickets' }" class="nav-link" role="tab" aria-controls="tickets" x-on:click.prevent="tab='#tickets'; window.location.hash = '#tickets'" id="tickets-tab">
                    Tickets
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#devices' }" class="nav-link" role="tab" aria-controls="devices" x-on:click.prevent="tab='#devices'; window.location.hash = '#devices'" id="devices-tab">
                    Devices
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#licenses' }" class="nav-link" role="tab" aria-controls="licenses" x-on:click.prevent="tab='#licenses'; window.location.hash = '#licenses'" id="ticklicenses">
                    Licenses
                </button>
            </li>
            <li class="nav-item">
                <button :class="{ 'active': tab === '#notes' }" class="nav-link" role="tab" aria-controls="notes" x-on:click.prevent="tab='#notes'; window.location.hash = '#notes'" id="notes-tab">
                    Notes
                </button>
            </li>
            <li class="nav-item ms-auto">
                <button :class="{ 'active': tab === '#history' }" class="nav-link" role="tab" aria-controls="history" x-on:click.prevent="tab='#history'; window.location.hash = '#history'" id="history-tab">
                    Revisions
                </button>
            </li>
        </ul>
    </div>
    <div class="content tab-content">
        <div x-show="tab == '#overview'" x-cloak id="overview" role="tabpanel" aria-labelledby="overview-tab">
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
        </div>
        <div x-show="tab == '#addresses'" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="row">
                        @foreach($customer->locations as $location)
                            <div class="col-lg-6">
                                <div class="block block-rounded block-bordered">
                                    <div class="block-header block-header-default">
                                        <h3 class="block-title">Address</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option">
                                                <i class="fas fa-home"></i>
                                            </button>
                                            <button type="button" class="btn-block-option">
                                                <i class="fas fa-truck"></i>
                                            </button>
                                            <button type="button" class="btn-block-option">
                                                <i class="fas fa-dollar-sign"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <address class="fs-sm">
                                            @if($location->name) {{ $location->name }} @else {{ $customer->name }} @endif<br>
                                            {{ $location->address }}<br>
                                            @if($location->address_2) {{ $location->address_2 }}<br> @endif
                                            {{ $location->city }}, {{ $location->state }} {{ $location->zip }}<br>
                                            {{ $location->phone }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div x-show="tab == '#contacts'" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
            <x-block><p>Contacts</p></x-block>
        </div>
        <div x-show="tab == '#tickets'" id="tickets" role="tabpanel" aria-labelledby="tickets-tab">
            <x-block><p>Tickets</p></x-block>
        </div>
        <div x-show="tab == '#devices'" id="devices" role="tabpanel" aria-labelledby="devices-tab">
            <x-block><p>Devices</p></x-block>
        </div>
        <div x-show="tab == '#licenses'" id="licenses" role="tabpanel" aria-labelledby="licenses-tab">
            <x-block><p>Licenses</p></x-block>
        </div>
        <div x-show="tab == '#notes'" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            @comments(['model' => $customer])
        </div>
        <div x-show="tab == '#history'" id="history" role="tabpanel" aria-labelledby="history-tab">
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
                            <td>{{ $history->created_at->setTimezone(auth()->user()->timezone)->format('Y-m-d h:i a') }}
                            </td>
                            @if ($history->key == 'created_at' && !$history->old_value)
                                <td>Created Customer</td>
                            @else
                                <td>{{ $history->fieldName() }} was changed from {{ $history->oldValue() }} to
                                    {{ $history->newValue() }}</td>
                            @endif
                            <td>{{ $history->userResponsible()->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-block>
        </div>
    </div>
</div>