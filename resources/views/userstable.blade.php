@extends('layouts.backend')
@section('content')
    <x-page-header title="Users Livewire Table Test"></x-page-header>
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Users Table</h3>
                    </div>
                    <div class="block-content">
                        <p>
                            <livewire:users-table />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
