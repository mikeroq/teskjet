<x-jet-action-section>
    <x-slot name="title">
        {{ __('Browser Sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and log out your active sessions on other browsers and devices.') }}
    </x-slot>

    <x-slot name="content">
        <x-jet-action-message on="loggedOut">
            {{ __('Done.') }}
        </x-jet-action-message>

        <div>
            {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-3">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="block block-rounded block-transparent bg-black-25">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-w600 mb-1">{{ $session->agent->platform() }} {{ $session->agent->version($session->agent->platform()) }} - {{ $session->agent->browser() }} {{ $session->agent->version($session->agent->browser()) }}</div>
                                <div class="font-size-sm text-muted">
                                    {{ $session->ip_address }},
                                    @if ($session->is_current_device)
                                        <span class="text-success font-weight-bold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                @if ($session->agent->isDesktop())
                                <svg fill="none" width="32" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                        <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                    </svg>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex mt-3">
            <x-jet-button class="mb-3" wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Log Out Other Browser Sessions') }}
            </x-jet-button>
        </div>
       
    </x-slot>

</x-jet-action-section>
