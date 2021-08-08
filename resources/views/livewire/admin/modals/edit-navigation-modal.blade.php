<div>
    <form wire:submit.prevent="update">
        @csrf
        <div class="block-content fs-sm">
            <x-form-group label="Link Title" id="title">
                <x-jet-input type="text" class="@error('title') is-invalid @enderror" id="title" required wire:model="title" autofocus />
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group label="Link Icon" id="icon">
                <div class="input-group">
                    <x-jet-input type="text" class="@error('icon') is-invalid @enderror" id="icon" wire:model="icon" />
                    <span class="input-group-text input-group-text-alt">
                        <i id="preview" class="{{ $icon }} fa-fw"></i>
                    </span>
                </div>
                @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
            <x-form-group label="URL Slug" id="url">
                <x-jet-input type="text" class="@error('url') is-invalid @enderror" id="url" required wire:model="url" />
            </x-form-group>
            <x-form-group>
                <x-select id="user_level" class="form-select @error('user_level') is-invalid @enderror" wire:model="user_level">
                    <option value="0" wire:key="0">All</option>
                    <option value="9" wire:key="9">Admin</option>
                </x-select>
                @error('user_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </x-form-group>
        </div>
        <div class="modal-footer modal-footer-fixed bg-dark bg-black-10">
            <button type="submit" class="btn btn-secondary btn-sm">
                <span>Update</span>
            </button>
        </div>
    </form>
</div>
