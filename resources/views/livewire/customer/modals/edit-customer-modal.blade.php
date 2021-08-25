<div>
    <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="block-content">
            <x-input label="Name" id="customer.name" wire:model.lazy="customer.name" required />
            <x-input label="Phone" id="customer.phone" wire:model.lazy="customer.phone" required />
                <x-select label="Type" id="customer.type" wire:model="customer.type" required>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option wire:key={{ $value }} value={{$value}}>{{ $label }}</option>
                    @endforeach
                </x-select>
            <x-checkbox label="Taxable" id="customer.taxable" value="{{ $customer->taxable }}" wire:model="customer.taxable" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-sm btn-secondary">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>