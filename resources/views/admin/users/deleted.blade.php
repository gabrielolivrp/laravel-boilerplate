@extends('layouts.admin')

@section('title', __('Users - Deleted'))

@section('breadcrumb-links')
    @include('admin.users.includes.dropdown-links')
@endsection

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-header">
            {{ __('Users deleted') }}
        </div>
        <div class="card-body">
            @livewire('admin.users-table', ['status' => 'deleted'])
        </div>
    </div>
@endsection

