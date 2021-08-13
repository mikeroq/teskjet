<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="modal-body">
            <x-input label="Location Name" id="name" wire:model="name" />
            <x-input label="Address" id="address" wire:model="address" required />
            <x-input label="Address 2" id="address_2" wire:model="address2" />
            <div class="row g-4">
                <div class="col-6">
                    <x-input wrapper="false" label="City" id="city" wire:model="city" required />
                </div>
                <div class="col-3">
                    <x-select label="State" id="state" required wire:model="state">
                        <option wire:key="">Select</option>
                        @foreach($state_list as $value)
                            <option value="{{ $value }}" wire:key="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-3">
                    <x-input wrapper="false" label="Zip" id="zip" wire:model="zip" required/>
                </div>
            </div>
            <x-input label="Phone" id="phone" wire:model="phone" required />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </form>
</div>