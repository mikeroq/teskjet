@extends('layouts.auth')

@section('content')
    <p class="text-uppercase font-w700 font-size-sm text-muted text-center">Create New Account</p>
    <x-jet-validation-errors class="mb-4" />
    <form id="register_form" action="{{ route('register') }}" method="POST">
        @csrf
            <div class="form-group">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" name="name"
                    :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div class="form-group">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" name="email"
                    :value="old('email')" required />
            </div>
            <div class="form-group">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" type="password" name="password"
                    required autocomplete="new-password" />
            </div>
            <div class="form-group">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="form-group">
                    <div class="custom-control custom-checkbox custom-control-primary">
                        <input type="checkbox" class="custom-control-input" name="terms" id="terms">
                        <label class="custom-control-label" for="terms">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '">' . __('Terms of Service') . '</a>',
                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '">' . __('Privacy Policy') . '</a>',
                            ]) !!}
                        </label>
                    </div>
                </div>
            @endif
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-hero btn-hero-primary">
                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Register
            </button>
            <a href="{{ route('login') }}" class="btn btn-block btn-hero btn-hero-info">
                <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign in to Existing Account
            </a>
        </div>
        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream-providers />
        @endif
    </form>
@endsection
