@extends('layouts.admin')

@section('title', __('Roles'))

@section('content')
<div class="main-card mb-3 card">
    <div class="card-header">
        {{ __('Roles') }}
        <div class="card-header-actions">
            @can('create role')
                <a class="card-header-action" href="{{ route('admin.roles.create') }}">
                    <i class="fas fa-plus mr-1"></i>{{ __('Create') }}
                </a>
            @endcan
        </div>
    </div>
    <div class="card-body">
        @livewire('admin.roles-table')
    </div>
</div>
@endsection

