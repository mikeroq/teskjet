@extends('layouts.auth2')

@section('content')
<div class="block block-rounded mb-0">
    <div class="block-header block-header-default">
        <h3 class="block-title">Verify Email Address</h3>
        <div class="block-options">
            <a class="btn-block-option" href="/" data-bs-toggle="tooltip" data-bs-placement="left" title="Go Home">
                <i class="fa fa-home"></i>
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
            <h1 class="h2 mb-1">{{ config('app.name')}}</h1>
            <p class="fw-medium text-muted">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <x-jet-validation-errors class="mb-3" />
            <x-form-group class="text-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <x-jet-button type="submit">
                            {{ __('Resend Verification Email') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-form-group>
            <x-form-group class="text-center">
                <form method="POST" action="/logout">
                    @csrf
                    <x-jet-button>
                        {{ __('Log Out') }}
                    </x-jet-button>
                </form>
            </x-form-group>
        </div>
    </div>
</div>
@endsection