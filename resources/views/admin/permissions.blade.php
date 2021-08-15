@extends('layouts.backend')

@section('title', 'Permissions Admin')
@section('content')
    <x-page-header title="Permission Management" subtitle="Admin Panel"></x-page-header>
    <div class="content">
        <x-block class="pb-3">
            <livewire:admin.permission-table />
        </x-block>
    </div>
@endsection