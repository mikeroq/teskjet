<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="modal-body">
            <x-input label="Name" id="name" wire:model="name" required />
            <x-input label="Phone" id="phone" wire:model="phone" required />
            <x-select id="type" label="Type" wire:model="type" required>
                <option disabled selected value="" wire:key="">--- Select Customer Type ---</option>
                @foreach (__('types/customer.type') as $value => $label)
                <option value="{{ $value }}" wire:key="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-select>
            <x-checkbox label="Taxable" id="taxable" wire:model="taxable" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                Add Customer
            </button>
        </div>
    </form>
</div>
