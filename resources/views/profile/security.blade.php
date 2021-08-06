@extends('layouts.backend')
@section('title', 'Account Security')
@section('content')
    <x-page-header title="{{ $user->name }}" subtitle="Account Security">
    </x-page-header>
    <div class="content">
        <div>
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
            @if ( ! is_null($user->password))
                <x-jet-section-border />
                @livewire('profile.logout-other-browser-sessions-form')
            @endif
        </div>
    </div>
@endsection
