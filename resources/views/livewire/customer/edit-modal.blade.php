<div>
    <form wire:submit.prevent="update">
        <div class="block-content fs-sm">
            <div class="mb-4">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control form-control-alt @error('name') is-invalid @enderror" wire:model="name" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label" for="phone">Phone</label>
                <input type="text" class="form-control form-control-alt @error('phone') is-invalid @enderror" wire:model="phone" required>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label" for="type">Type</label>
                <select class="form-control form-control-alt @error('type') is-invalid @enderror" wire:model="type" required>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}" wire:key="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{ $taxable }}" wire:model="taxable">
                <label class="form-check-label" for="example-checkbox-default1">Taxable</label>
            </div>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-sm btn-secondary">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>