@extends('layouts.backend')
@section('content')
    <x-page-header title="Users Livewire Table Test"></x-page-header>
    <div class="content">
        <x-block title="Users Table">
            <p>
                <livewire:users-table />
            </p>
        </x-block>
    </div>
@endsection
