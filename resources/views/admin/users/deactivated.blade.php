@extends('layouts.admin')

@section('title', __('Users - Deactivated'))

@section('breadcrumb-links')
    @include('admin.users.includes.dropdown-links')
@endsection

@section('content')
     <div class="main-card mb-3 card">
         <div class="card-header">
             {{ __('Users deactivated') }}
         </div>
         <div class="card-body">
             @livewire('admin.users-table', ['status' => 'deactivated'])
         </div>
     </div>
@endsection
