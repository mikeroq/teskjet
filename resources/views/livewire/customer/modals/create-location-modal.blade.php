<div>
    <form wire:submit.prevent="create">
        @csrf
        <div class="modal-body">
            <x-input label="Location Name" id="location.name" wire:model.lazy="location.name" autocomplete="organization" />
            <x-input label="Address" id="location.address" wire:model.lazy="location.address" required autocmplete="address-line-1" />
            <x-input label="Address 2" id="location.address_2" wire:model.lazy="location.address_2" autcomplete="address-line-2" />
            <div class="row g-4">
                <div class="col-6">
                    <x-input wrapper="false" label="City" id="location.city" wire:model.lazy="location.city" required autocomplete="address-level2" />
                </div>
                <div class="col-3">
                    <x-select label="State" id="location.state" required wire:model.lazy="location.state" autocomplete="address-level1">
                        <option wire:key="">Select</option>
                        @foreach(trans('locations.states') as $value)
                            <option value="{{ $value }}" wire:key="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-3">
                    <x-input wrapper="false" label="Zip" id="location.zip" wire:model.lazy="location.zip" required autocomplete="postal-code" />
                </div>
            </div>
            <x-input label="Phone" id="location.phone" wire:model.lazy="location.phone" />
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-primary">
                Add Location
            </button>
        </div>
    </form>
</div>