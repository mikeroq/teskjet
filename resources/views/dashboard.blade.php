@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
    <x-page-header title="Dashboard"></x-page-header>
    <div class="content">
        <x-block title="Dashboard">
                We’ve put everything together, so you can start working on your Laravel project as soon as possible! Dashmix assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.

            <p>
                Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
            </p>
            <x-jet-danger-button onclick="Livewire.emit('openModal', 'profile.remove-connected-account')" wire:loading.attr="disabled">
                {{ __('Remove') }}
            </x-jet-danger-button>
        </x-block>
    </div>
@endsection