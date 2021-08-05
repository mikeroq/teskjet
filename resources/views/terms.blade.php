@extends('layouts.simple')

@section('content')

<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <div class="bg-body-extra-light">
            <div class="content content-full">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-6 py-4">
                        <div class="text-center mb-5">
                            <p class="mb-2">
                                <i class="far fa-2x fa-life-ring text-primary"></i>
                            </p>
                            <a class="link-fx fw-semibold fs-2 text-white" href="/">
                                {{ config('app.name') }}
                            </a>
                        </div>
                        <hr>
                        {!! $terms !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="fs-sm text-center text-muted py-3">
            <strong>{{ config('app.name')}}</strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
@endsection
