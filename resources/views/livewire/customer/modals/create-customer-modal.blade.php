<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="modal-body">
            <x-input label="Name" id="customer.name" wire:model.lazy="customer.name" required />
            <x-input label="Phone" id="customer.phone" wire:model.defer="customer.phone" required />
            <x-select id="customer.type" label="Type" wire:model.lazy="customer.type" required>
                <option selected value="" wire:key="">--- Select Customer Type ---</option>
                @foreach (__('types/customer.type') as $value => $label)
                <option value="{{ $value }}" wire:key="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-checkbox label="Taxable" id="customer.taxable" wire:model.lazy="customer.taxable" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                Add Customer
            </button>
        </div>
    </form>
</div>
