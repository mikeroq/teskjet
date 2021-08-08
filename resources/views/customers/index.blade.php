@extends('layouts.backend')

@section('title', 'Customer List')
@section('content')
    <x-page-header title="Customer List"></x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:customer-list/>
        </x-block>
    </div>
@endsection