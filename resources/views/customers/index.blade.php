@extends('layouts.backend')

@section('title', 'Customer List')
@section('content')
    <x-page-header title="Customer List">
        <button class="btn btn-secondary" onclick="Livewire.emit('openModal', 'customer.modals.create-customer-modal')">Add Customer</button>
    </x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:customer.list-customer/>
        </x-block>
    </div>
@endsection