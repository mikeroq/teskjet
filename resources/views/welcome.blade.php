@extends('layouts.simple')

@section('content')
    <div class="hero bg-body-extra-light overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <h1 class="fw-bold mb-2">
                    {{ config('app.name') }}
                </h1>
                <p class="fs-lg fw-medium text-muted mb-4">
                    Welcome to {{ config('app.name') }}. Click below to get started!
                </p>
                <a class="btn btn-alt-primary" href="/dashboard">
                    Enter Dashboard
                    <i class="fa fa-fw fa-arrow-right opacity-50 ms-1"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
