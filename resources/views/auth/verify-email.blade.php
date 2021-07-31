@extends('layouts.simple')

@section('content')
    <div class="bg-image" style="background-image: url('assets/media/photos/photo16@2x.jpg');">
        <div class="row no-gutters justify-content-center bg-black-75">
            <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                    <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                        <div class="mb-2 text-center">
                            <a class="link-fx text-warning font-w700 font-size-h1" href="/">
                                <span class="text-dark">{{ config('app.name') }}</span>
                            </a>
                            <p class="text-uppercase font-w700 font-size-sm text-muted">Verify Email</p>
                            <p>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </p>
                        </div>
                        @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                        @endif
                        <x-jet-validation-errors class="mb-3" />
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-jet-button type="submit">
                                    {{ __('Resend Verification Email') }}
                                </x-jet-button>
                            </div>
                        </form>
                        <form method="POST" action="/logout">
                            @csrf

                            <button type="submit" class="btn btn-link">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


