@extends('layouts.auth')

@section('content')
<div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
    <div class="w-100">
        <div class="text-center mb-5">
            <p class="mb-3">
                <i class="ico-send fa-3x text-primary-light"></i>
            </p>
            <p class="fw-medium text-muted">
                Already have an account? Log in <a href="{{ route('login') }}">here</a>
            </p>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-sm-8 col-xl-4">
                <x-jet-validation-errors class="mb-4" />
                <form id="register_form" action="{{ route('register') }}" method="POST">
                    @csrf
                    <x-form-group label="Name" id="name">
                        <x-jet-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </x-form-group>
                    <x-form-group label="Email Address" id="email">
                        <x-jet-input id="email" type="email" name="email" :value="old('email')" required />
                    </x-form-group>
                    <x-form-group label="Password" id="password">
                        <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" />
                    </x-form-group>
                    <x-form-group label="Confirm Password" id="password_confirmation">
                        <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </x-form-group>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mb-4">
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            
                        </div>
                        <div>
                            <button type="submit" class="btn btn-dark">
                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Register
                            </button>
                        </div>
                    </div>
                </form>
                <div class="d-grid gap-2">
                    @if (JoelButcher\Socialstream\Socialstream::show())
                        <x-socialstream-providers />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
