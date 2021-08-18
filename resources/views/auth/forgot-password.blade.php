@extends('layouts.auth2')

@section('content')
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">Forgot Password</h3>
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
                    Enter your email below and we will send you a link to reset your password.
                </p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <x-jet-validation-errors class="mb-3"/>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <x-form-group id="email" label="Email Address">
                        <x-jet-input type="text" class="form-control form-control-alt" id="email" name="email"
                               value="{{ old('email') }}" required autofocus/>
                    </x-form-group>
                    <x-form-group class="text-center">
                        <x-jet-button>
                            <i class="fa fa-fw fa-reply me-1"></i> {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </x-form-group>
                </form>
            </div>
        </div>
    </div>
@endsection