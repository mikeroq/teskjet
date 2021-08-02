@extends('layouts.auth')

@section('content')
    <p class="text-uppercase font-w700 font-size-sm text-muted text-center">Confirm Password</p>
    <p>{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
    <x-jet-validation-errors class="mb-4" />
    <form action="{{ route('password.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" autofocus />
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-hero-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
@endsection