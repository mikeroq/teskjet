<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="modal-body bg-dark text-gray">
            <x-form-group label="Name" id="name">
                <x-jet-input type="text" class="@error('name') is-invalid @enderror" wire:model="name" required />
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group label="Phone" id="phone">
                <x-jet-input type="text" class="@error('phone') is-invalid @enderror" wire:model="phone" required>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group class="form-group">
                <x-select id="type" label="Type" class="@error('type') is-invalid @enderror" wire:model="type" required>
                    <option>--- Select Customer Type ---</option>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group>
                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                    <input type="checkbox" class="custom-control-input" id="taxable" name="taxable" wire:model="taxable" checked>
                    <label class="custom-control-label" for="taxable">Taxable</label>
                </div>
            </x-form-group>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                <span>Add Customer</span>
            </button>
        </div>
    </form>
</div>
