<div>
    <form wire:submit.prevent="create">
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
                    <option>--- Select Customer Type ---</option>
                    @foreach (__('types/customer.type') as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-primary mb-1">
                    <input type="checkbox" class="custom-control-input" id="taxable" name="taxable" wire:model="taxable" checked>
                    <label class="custom-control-label" for="taxable">Taxable</label>
                </div>
            </div>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                <span>Add Customer</span>
            </button>
        </div>
    </form>
</div>
