<div>
    <form wire:submit.prevent="update">
        <div class="modal-body bg-dark text-gray">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" required>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control @error('type') is-invalid @enderror" wire:model="type" required>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}" wire:key="{{ $value }}"></option>{{ $label }}</option>
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
            <button type="submit" class="btn btn-primary">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>

