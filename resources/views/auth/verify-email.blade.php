@extends('layouts.auth')

@section('content')
<div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
    <div class="w-100">
        <div class="text-center mb-5">
            <p class="mb-3">
                <i class="ico-send fa-3x text-primary-light"></i>
            </p>
            <p class="fw-medium text-muted">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-sm-8 col-xl-4">
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
                    <x-jet-button>
                        {{ __('Log Out') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


