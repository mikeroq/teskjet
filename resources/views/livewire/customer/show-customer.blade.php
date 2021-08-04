<div>
<x-page-header :title="$customer->name" subtitle="Viewing Customer">
    <x-action-dropdown id="customer_action_dropdown">
        <a class="dropdown-item" wire:click='$emit("openModal", "customer.edit-modal", {{ json_encode(["customerId" => $customer->id]) }})'>
            <i class="fas fa-edit mr-1 fa-fw"></i>
            Edit Customer
        </a>
        <a class="dropdown-item" data-toggle="modal" data-target="#customer_location_create_modal">
            <i class="fas fa-location-arrow mr-1 fa-fw"></i>
            Add Location
        </a>
        <a class="dropdown-item" id="del">
            <i class="fas fa-times mr-1 fa-fw"></i>
            Delete Customer
        </a>
    </x-action-dropdown>
</x-page-header>
<div class="content">
    <div class="block block-rounded block-themed block-transparent bg-black-25">
        <div class="block-header block-header-default bg-black-10">
            <h3 class="block-title">Customer Information</h3>
        </div>
        <div class="block-content text-gray">
            <p>
                {{ $customer->name }}<br />
                {{ $customer->formatted_phone }}<br />
                {{ $customer->type }}<br />
                {{ $customer->displayable_taxable }}<br />
                {{ $customer->created_at->format('Y-m-d h:i a') }}
            </p>
            <table class="table table-striped table-dark">
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
        </div>
    </div>
</div>
</div>
