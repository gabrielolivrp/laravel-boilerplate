@extends('layouts.admin')

@section('title', __('Users'))

@section('breadcrumb-links')
    @include('admin.users.includes.dropdown-links')
@endsection

@section('content')
<div class="main-card mb-3 card">
    <div class="card-header">
        {{ __('Users') }}
        <div class="card-header-actions">
            @can('create user')
                <a class="card-header-action" href="{{ route('admin.users.create') }}">
                    <i class="fas fa-plus mr-1"></i>{{ __('Create') }}
                </a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        @livewire('admin.users-table')
    </div>
</div>
@endsection

