<x-jet-action-section>
    <x-slot name="title">
        {{ __('Connected Accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and remove your connect accounts.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="h5 font-weight-bold text-gray-light">
            @if (count($this->accounts) == 0)
                {{ __('You have no connected accounts.') }}
            @else
                {{ __('Your connected accounts.') }}
            @endif
        </h3>

        <p class="mt-3">
            {{ __('You are free to connect any social accounts to your profile and may remove any connected accounts at any time. If you feel any of your connected accounts have been compromised, you should disconnect them immediately and change your password.') }}
        </p>

        <div>
            @foreach ($this->providers as $provider)
                @php
                    $account = null;
                    $account = $this->accounts->where('provider', $provider)->first();
                @endphp

                <div>
                    @if (! is_null($account))
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <button class="btn btn-block btn-alt-primary d-flex align-items-center justify-content-between" disabled>
                                    <span>
                                        <i class="fab fa-fw fa-{{ $provider }} opacity-50 mr-1"></i>
                                        {{ $account->name }}
                                    </span>
                                    <i class="fa fa-fw fa-check mr-1"></i>
                                </button>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-6 d-md-flex align-items-md-center">
                                <div class="flex items-center space-x-6">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() && ! is_null($account->avatar_path))
                                        <x-jet-secondary-button wire:click="setAvatarAsProfilePhoto({{ $account->id }})">
                                            <i class="fas fa-fw fa-image mr-1"></i> {{ __('Use Avatar') }}
                                        </x-jet-secondary-button>
                                    @endif
                                    @if (($this->accounts->count() > 1 || ! is_null($this->user->password)))

                                        <x-jet-danger-button onclick="Livewire.emit('openModal', 'profile.remove-connected-account')" wire:loading.attr="disabled">
                                            {{ __('Remove') }}
                                        </x-jet-danger-button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group row">
                            <div class="col-sm-10 col-md-8 col-xl-6">
                                <a class="btn btn-block btn-dark text-left" href="{{ route('oauth.redirect', ['provider' => $provider]) }}">
                                    <i class="fab fa-fw fa-{{ $provider }} opacity-50 mr-1"></i>
                                    Connect to {{ __(ucfirst($provider)) }}
                                </a>
                            </div>
                        </div>
                    @endif
                    @error($provider.'_connect_error')
                        <div class="text-sm font-semibold text-red-500 px-3 mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endforeach
        </div>
    </x-slot>
</x-jet-action-section>
