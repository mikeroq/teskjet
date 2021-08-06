@extends('layouts.auth')

@section('content')
<div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
    <div class="w-100">
        <div class="text-center mb-5">
            <p class="mb-3">
                <i class="ico-send fa-3x text-primary-light"></i>
            </p>
            <p class="fw-medium text-muted">
                Reset Password
            </p>
        </div>
        <div class="row g-0 justify-content-center">
            <div class="col-sm-8 col-xl-4">
                <x-jet-validation-errors class="mb-4" />
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <x-form-group label="Email Address" name="email">
                        <x-jet-input id="email" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus />
                    </x-form-group>
                    <x-form-group label="New Password" name="password">
                        <x-jet-input id="password" type="password" name="password" required autocomplete="new-password" />
                    </x-form-group>
                    <x-form-group label="Confirm New Password" name="password_confirmation">
                        <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </x-form-group>
                    <x-form-group>
                        <x-jet-button>
                            {{ __('Reset Password') }}
                        </x-jet-button>
                    </x-form-group>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection