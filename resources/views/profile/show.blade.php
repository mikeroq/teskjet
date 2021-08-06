@extends('layouts.backend')
@section('title', 'Edit Profile')
@section('content')
    <x-page-header title="{{ $user->name }}" subtitle="Edit Profile">
    </x-page-header>
    <div class="content">
        <div>
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <x-jet-section-border />
            @endif
        </div>
    </div>
@endsection
