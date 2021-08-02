@extends('layouts.auth')

@section('content')
    <p class="text-uppercase font-w700 font-size-sm text-muted text-center">Forgot Password</p>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <x-jet-validation-errors class="mb-3" />
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="email" name="email"
                placeholder="Enter your Email Address" value="{{ old('email') }}" required
                autofocus>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-hero-primary">
                <i class="fa fa-fw fa-reply mr-1"></i> {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection