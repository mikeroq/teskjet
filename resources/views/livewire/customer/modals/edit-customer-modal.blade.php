<div>
    <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="block-content fs-sm">
            <x-input label="Name" id="name" wire:model="customer.name" required />
            <x-input label="Phone" id="phone" wire:model="customer.phone" required />
            <x-select label="Type" id="type" wire:model="customer.type" required>
                @foreach (__('types/customer.type') as $value => $label)
                <option value="{{ $value }}" wire:key="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-checkbox label="Taxable" id="taxable" value="{{ $customer->taxable }}" wire:model="customer.taxable" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-sm btn-secondary">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>