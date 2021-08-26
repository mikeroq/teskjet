<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="modal-body">
            <x-input label="Location Name" id="location.name" wire:model="location.name" />
            <x-input label="Address" id="location.address" wire:model="location.address" required />
            <x-input label="Address 2" id="location.address_2" wire:model="location.address_2" />
            <div class="row g-4">
                <div class="col-6">
                    <x-input wrapper="false" label="City" id="location.city" wire:model="location.city" required />
                </div>
                <div class="col-3">
                    <x-select label="State" id="location.state" required wire:model="location.state">
                        <option wire:key="">Select</option>
                        @foreach(trans('locations.states') as $value)
                            <option value="{{ $value }}" wire:key="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-3">
                    <x-input wrapper="false" label="Zip" id="location.zip" wire:model="location.zip" required/>
                </div>
            </div>
            <x-input label="Phone" id="location.phone" wire:model="location.phone" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </form>
</div>