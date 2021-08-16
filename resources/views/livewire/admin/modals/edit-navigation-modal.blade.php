<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="block-content">
            <x-input label="Link Title" id="title" wire:model="title" required autofocus />
            @if($type === "parent")
            <x-form-group label="Link Icon" id="icon">
                <div class="input-group">
                    <x-input wrapper="false" id="icon" wire:model="icon" />
                    <span class="input-group-text input-group-text-alt">
                        <i id="preview" class="{{ $icon }} fa-fw"></i>
                    </span>
                </div>
            </x-form-group>
            @endif
            <x-form-group label="URL Slug" id="url">
                <div class="input-group">
                    <span class="input-group-text input-group-text-alt">
                        /
                    </span>
                    <x-input wrapper="false" id="url" wire:model="url" required />
                </div>
            </x-form-group>
            <x-select label="User Level" id="user_level" wire:model="user_level" required>
                <option value="0" wire:key="0">All</option>
                <option value="9" wire:key="9">Admin</option>
            </x-select>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="is_hidden" wire:model="is_hidden">
                <label class="form-check-label" for="is_hidden">Hidden</label>
            </div>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>
