<x-jet-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold text-gray-light">
            @if ($this->enabled)
                {{ __('You have enabled two factor authentication.') }}
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($showingRecoveryCodes)
            <p class="mt-3">
                {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
            </p>
            <div class="bg-dark rounded p-3 mb-3">

                    <code class="text-body-color-light font-size-sm font-monospace">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        {{ $code }}<br>
                        @endforeach
                    </code>

            </div>
        @endif

        @if ($this->setup || $showingQrCode)
            <p class="mt-3">
                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
            </p>
            <div class="mt-3">
                <div style="border: 3px #fff solid; width: 198px;">{!! $this->user->twoFactorQrCodeSvg() !!}</div>

            </div>
        @endif

        @if ($this->setup)
            <p class="mt-3">

                    <x-jet-label for="confirmationCode" value="{{ __('After configuring the authenticator application, enter the code to validate the two-factor authentication.') }}" />
                    <x-jet-input id="confirmationCode" type="text" class="mt-1 block w-full" wire:model.defer="confirmationCode" />
                    <x-jet-input-error for="confirmationCode" class="mt-2" />

            </p>
        @endif

        <div class="mt-3">
            @if (! $this->setup && !$this->enabled)

                <x-jet-button type="button" wire:loading.attr="disabled" wire:click="generateTwoFactorAuthenticationSecret">
                    {{ __('Enable') }}
                </x-jet-button>

            @else
                @if ($showingRecoveryCodes)

                        <x-jet-secondary-button wire:click="regenerateRecoveryCodes">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-jet-secondary-button>

                @else
                        <x-jet-secondary-button wire:click="showRecoveryCodes">
                            {{ __('Show Recovery Codes') }}
                        </x-jet-secondary-button>

                @endif

                @if($this->enabled)
                        <x-jet-danger-button  wire:loading.attr="disabled" wire:click="disableTwoFactorAuthentication">
                            {{ __('Disable') }}
                        </x-jet-danger-button>
                @else
                    <x-jet-button wire:click="confirmEnableTwoFactorAuthentication" wire:loading.attr="disabled">
                        {{ __('Confirm') }}
                    </x-jet-button>
                @endif
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
