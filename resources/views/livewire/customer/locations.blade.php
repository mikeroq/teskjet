<div>
    <div class="block block-rounded" wire:loading.class="block-mode-loading block-mode-loading-refresh">
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
                    @foreach($customer->fetchLocations() as $location)
                        <tr>
                            <td>@if($location->name) {{ $location->name }} @else {{ $customer->name }} @endif</td>
                            <td>{{ $location->address }}@if($location->address_2), {{$location->address_2 }}@endif</td>
                            <td>{{ $location->city }}</td>
                            <td>{{ $location->state }} </td>
                            <td>{{ $location->zip }}</td>
                            <td>@if($location->phone) {{ $location->phone }} @else {{ $customer->phone }} @endif</td>
                            <td class="text-end">
                                @if($customer->default_address === $location->id)
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-option-disabled disabled" title="Primary address" disabled>
                                        <i class="fas fa-star"></i>
                                    </button>
                                @else
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-faded" wire:click="setDefaultAddress({{ $location->id }})" title="Set as primary address">
                                        <i class="fas fa-star"></i>
                                    </button>
                                @endif
                                @if($customer->billing_address === $location->id)
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-option-disabled  disabled" title="Billing address" disabled>
                                        <i class="fas fa-dollar-sign"></i>
                                    </button>
                                @else
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-faded" wire:click="setBillingAddress({{ $location->id }})" title="Set as billing address">
                                        <i class="fas fa-dollar-sign"></i>
                                    </button>
                                @endif
                                @if($customer->shipping_address === $location->id)
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-option-disabled  disabled" title="Shipping address" disabled>
                                        <i class="fas fa-truck"></i>
                                    </button>
                                @else
                                    <button onclick="this.blur()" type="button" class="btn-block-option btn-block-faded" wire:click="setShippingAddress({{ $location->id }})" title="Set as shipping address">
                                        <i class="fas fa-truck"></i>
                                    </button>
                                @endif

                                <button onclick="this.blur()" type="button" class="btn-block-option" wire:click="$emit('openModal', 'customer.modals.edit-location-modal', {{ json_encode(['locationId' => $location->id], JSON_THROW_ON_ERROR) }})" title="Edit address">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button onclick="this.blur()" type="button" class="btn-block-option" wire:click="triggerLocationDelete({{ $location->id }})" title="Delete address">
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
</div>
