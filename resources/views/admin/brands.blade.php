@extends('layouts.backend')

@section('title', 'Brands Admin')
@section('content')
    <x-page-header title="Brands Management" subtitle="Admin Panel">
        <x-action-dropdown id="brands_action_dropdown">
            <button class="dropdown-item" onclick="Livewire.emit('openModal', 'admin.modals.create-brand')">
                <i class="fas fa-plus mr-1 fa-fw"></i>
                Add Brand
            </button>
        </x-action-dropdown>
    </x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.brand-table />
        </x-block>
    </div>
@endsection