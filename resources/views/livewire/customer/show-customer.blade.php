<div x-data="{ tab: window.location.hash ? window.location.hash : '#overview' }" class="">
    <x-page-header :title="$customer->name" subtitle="Viewing Customer">
        <x-action-dropdown id="customer_action_dropdown">
            <button class="dropdown-item" wire:click='$emit("openModal", "customer.modals.edit-customer-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
                <i class="fas fa-edit me-1 fa-fw"></i>
                Edit Customer
            </button>
            <button class="dropdown-item" wire:click='$emit("openModal", "customer.modals.create-location-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
                <i class="fas fa-location-arrow me-1 fa-fw"></i>
                Add Location
            </button>
            <button class="dropdown-item" wire:click="triggerDelete()">
                <i class="fas fa-times me-1 fa-fw"></i>
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
    <div class="content">
        <div class="tab-content">
            <x-tab-pane id="overview">
                <x-block>
                    <p>Stuff</p>
                </x-block>
            </x-tab-pane>
            <x-tab-pane id="addresses">
                <livewire:customer.locations :customer="$customer"/>
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
                <livewire:customer.history :customer="$customer" />
            </x-tab-pane>
        </div>
    </div>
</div>