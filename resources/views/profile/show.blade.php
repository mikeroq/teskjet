@extends('layouts.backend')

@section('content')
    <x-page-header title="{{ $user->name }}" subtitle="Edit Profile">
    </x-page-header>
    <div class="content">
        <div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-jet-section-border />
            @endif
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()) && ! is_null($user->password))
                @livewire('profile.update-password-form')
                <x-jet-section-border />
            @else
                @livewire('profile.set-password-form')
                <x-jet-section-border />
            @endif
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication() && ! is_null($user->password))
                @livewire('profile.two-factor-authentication-form')
                <x-jet-section-border />
            @endif
            @if (JoelButcher\Socialstream\Socialstream::show())
                @livewire('profile.connected-accounts-form')
            @endif
            @if ( ! is_null($user->password))
                <x-jet-section-border />
                @livewire('profile.logout-other-browser-sessions-form')
            @endif
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures() && ! is_null($user->password))
                <x-jet-section-border />
                @livewire('profile.delete-user-form')
            @endif
        </div>
    </div>
@endsection
