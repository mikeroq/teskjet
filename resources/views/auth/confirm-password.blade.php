@extends('layouts.auth2')

@section('content')
    <div class="block block-rounded mb-0">
        <div class="block-header block-header-default">
            <h3 class="block-title">Confirm Password</h3>
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
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <x-jet-validation-errors class="mb-4"/>
                <form action="{{ route('password.confirm') }}" method="POST">
                    @csrf
                    <x-form-group id="password" label="Password">
                        <x-jet-input id="password" type="password" name="password" required
                                     autocomplete="current-password" autofocus/>
                    </x-form-group>
                    <x-form-group class="text-center">
                        <x-jet-button>
                            {{ __('Confirm') }}
                        </x-jet-button>
                    </x-form-group>
                </form>
            </div>
        </div>
    </div>
@endsection