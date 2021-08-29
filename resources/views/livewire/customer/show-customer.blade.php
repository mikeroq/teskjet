<main id="main-container" x-data="{ tab: window.location.hash ? window.location.hash : '#overview' }">
    <x-page-header :title="$customer->name" subtitle="Viewing Customer">
        <x-action-dropdown id="customer_action_dropdown">
            <button class="dropdown-item"
                    wire:click='$emit("openModal", "customer.modals.edit-customer-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
                <i class="fas fa-edit me-1 fa-fw"></i>
                Edit Customer
            </button>
            <button class="dropdown-item"
                    wire:click='$emit("openModal", "customer.modals.create-location-modal", {{ json_encode(["customerId" => $customer->id], JSON_THROW_ON_ERROR) }})'>
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
    <x-tab-pane id="overview" class="row g-0 flex-md-10-auto" :wrapper=false>
        <div class="col-md-4 col-lg-5 col-xl-3 order-md-1 order-sm-0 order-0 bg-body-dark">
            <div class="content">
                <div class="d-md-none push">
                    <button type="button" class="btn btn-block btn-secondary" data-bs-toggle="collapse"
                            data-bs-target="#side-content" data-class="d-none">
                        Customer Details
                    </button>
                </div>
                <div id="side-content" class="collapse d-md-block push">
                    <h2 class="h4 font-w400">About</h2>
                    <table class="table table-striped table-sm">
                        <tr>
                            <td>Type</td>
                            <td class="text-end">{{ $customer->displayable_type }}</td>
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td class="text-end">{{ $customer->displayable_created_at }}</td>
                        </tr>
                        <tr>
                            <td>Taxable</td>
                            <td class="text-end">{{ $customer->displayable_taxable }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-7 col-xl-9 order-md-0 order-sm-1 order-1">
            <div class="content content-full">
                <x-block>
                    <p>Test</p>
                </x-block>
            </div>
        </div>
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
        <livewire:customer.history :customer="$customer"/>
    </x-tab-pane>
</main>