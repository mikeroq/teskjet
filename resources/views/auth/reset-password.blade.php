@extends('layouts.auth2')

@section('content')
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">Reset Password</h3>
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
                    Please enter your new password below.
                </p>
                <x-jet-validation-errors class="mb-4"/>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <x-form-group label="Email Address" name="email">
                        <x-jet-input id="email" type="email" name="email"
                                     :value="old('email', $request->email)" required autofocus/>
                    </x-form-group>
                    <x-form-group label="New Password" name="password">
                        <x-jet-input id="password" type="password" name="password" required
                                     autocomplete="new-password"/>
                    </x-form-group>
                    <x-form-group label="Confirm New Password" name="password_confirmation">
                        <x-jet-input id="password_confirmation" type="password" name="password_confirmation" required
                                     autocomplete="new-password"/>
                    </x-form-group>
                    <x-jet-button>
                        {{ __('Reset Password') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
@endsection