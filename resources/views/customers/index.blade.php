@extends('layouts.backend')

@section('title', 'Customer List')
@section('content')
    <x-page-header title="Customer List"></x-page-header>
    <div class="content p-0">
        <div class="block block-themed block-transparent bg-black-25 mb-0">
            <div class="block-content text-gray pb-3">
                <livewire:customer-list />
            </div>
        </div>
    </div>
@endsection