@extends('layouts.auth')

@section('content')
    <p class="text-uppercase font-w700 font-size-sm text-muted text-center">Reset Password</p>
    <x-jet-validation-errors class="mb-4" />
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="form-group">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" name="email"
                :value="old('email', $request->email)" required autofocus />
        </div>
        <div class="form-group">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" type="password" name="password" required
                autocomplete="new-password" />
        </div>
        <div class="form-group">
            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-jet-input id="password_confirmation" type="password"
                name="password_confirmation" required autocomplete="new-password" />
        </div>
        <div class="form-group text-center">
            <x-jet-button>
                {{ __('Reset Password') }}
            </x-jet-button>
        </div>
    </form>
@endsection