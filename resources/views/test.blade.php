@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
    <x-page-header title="Dashboard"></x-page-header>
    <div class="content">
        <x-block title="Dashboard">
            <form action="{{ route('test.create') }}" method="POST">
            @csrf
                <x-input id="phone" name="phone" label="Phone" />
                <x-jet-button>Submit</x-jet-button>
            </form>
        </x-block>
    </div>
@endsection