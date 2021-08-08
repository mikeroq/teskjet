<div>
    <form wire:submit.prevent="update">
        @csrf
        @method('PATCH')
        <div class="block-content fs-sm">
            <x-form-group label="Name" id="name">
                <x-jet-input type="text" class="form-control form-control-alt @error('name') is-invalid @enderror" wire:model="name" required />
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group label="Phone" id="phone">
                <x-jet-input type="text" class="form-control form-control-alt @error('phone') is-invalid @enderror" wire:model="phone" required />
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group>
                <x-select label="Type" class="@error('type') is-invalid @enderror" wire:model="type" required>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}" wire:key="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </x-select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <div class="form-check">
                <input class="form-check-input" id="taxable" type="checkbox" value="{{ $taxable }}" wire:model="taxable">
                <label class="form-check-label" for="taxable">Taxable</label>
            </div>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-sm btn-secondary">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>