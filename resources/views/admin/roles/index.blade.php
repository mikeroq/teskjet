@extends('layouts.backend')

@section('title', 'Roles Admin')
@section('content')
    <x-page-header title="Role Management" subtitle="Admin Panel"></x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.role-table />
        </x-block>
    </div>
@endsection