<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="block-content fs-sm">
            <x-input label="Link Title" id="title" wire:model="title" required autofocus />
            <x-form-group label="Link Icon" id="icon">
                <div class="input-group">
                    <x-input wrapper="false" id="icon" wire:model="icon" />
                    <span class="input-group-text input-group-text-alt">
                        <i id="preview" class="{{ $icon }} fa-fw"></i>
                    </span>
                </div>
            </x-form-group>
            <x-input label="URL Slug" id="url" wire:model="url" required />
            <x-select label="User Level" id="user_level" wire:model="user_level" required>
                <option value="0" wire:key="0">All</option>
                <option value="9" wire:key="9">Admin</option>
            </x-select>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>
