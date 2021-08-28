@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
    <x-page-header title="Dashboard"></x-page-header>
    <div class="row g-0 flex-md-10-auto">
        <div class="col-md-4 col-lg-5 col-xl-3 order-md-1 order-sm-0 order-0 bg-body-dark">
            <div class="content">
                <div class="d-md-none push">
                    <button type="button" class="btn btn-block btn-secondary" data-bs-toggle="collapse" data-bs-target="#side-content" data-class="d-none">
                        Customer Details
                    </button>
                </div>
                <div id="side-content" class="collapse d-md-block push">
                    <h2 class="h4 font-w400">About</h2>
                    <p class="mb-2">
                        This is an important project where we should focus our main efforts for the next few years.
                    </p>
                    <p class="text-muted">
                        November 6, 2023
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-7 col-xl-9 order-md-0 order-sm-1 order-1">
            <div class="content content-full">
                <x-block>
                    <p>Test</p>
                </x-block>
            </div>
        </div>
    </div>
@endsection