<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
            <x-form-group label="Current Password" id="current_password">
                <x-jet-input id="current_password" type="password" class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-jet-input-error for="current_password" />
            </x-form-group>
            <x-form-group label="New Password" id="password">
                <x-jet-input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.password" autocomplete="new-password" />
                <x-jet-input-error for="password" />
            </x-form-group>
            <x-form-group label="Confirm New Password" id="password_confirmation">
                <x-jet-input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                    wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-jet-input-error for="password_confirmation" />
            </x-form-group>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Change Password') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
