@extends('layouts.simple')

@section('content')
    <div class="bg-image" style="background-image: url('/assets/media/photos/photo16@2x.jpg');">
        <div class="row no-gutters justify-content-center bg-black-75">
            <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                <div class="p-3 w-100">
                    <div class="mb-3 text-center">
                        <a class="link-fx font-w700 font-size-h1" href="/">
                            {{ config('app.name') }}
                        </a>
                        <p class="text-uppercase font-w700 font-size-sm text-muted">Create An Account</p>
                    </div>
                    <div class="row no-gutters justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <x-jet-validation-errors class="mb-4" />
                            <form id="register_form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="py-3">
                                    <div class="form-group">
                                        <x-jet-label for="name" value="{{ __('Name') }}" />
                                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                                    <div class="form-group">
                                        <x-jet-label for="email" value="{{ __('Email') }}" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                    </div>
                                    <div class="form-group">
                                        <x-jet-label for="password" value="{{ __('Password') }}" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                    </div>
                                    <div class="form-group">
                                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    </div>
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox custom-control-primary">
                                            <input type="checkbox" class="custom-control-input" name="terms" id="terms">
                                            <label class="custom-control-label" for="terms">{!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                        ]) !!}</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-hero btn-hero-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Register
                                    </button>
                                    <a href="{{ route('login') }}" class="btn btn-block btn-hero btn-hero-secondary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign in to Existing Account
                                    </a>
                                </div>
                                @if (JoelButcher\Socialstream\Socialstream::show())
                                    <x-socialstream-providers />
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
