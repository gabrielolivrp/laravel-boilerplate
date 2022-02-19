@extends('layouts.admin')

@section('title', __('Users - Edit'))

@section('content')
<div class="main-card mb-3 card">

    <div class="card-header">
        <div>{{ __('User') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="position-relative row form-group">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Full name') }}</label>
                <div class="col-sm-4">
                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @endif" value="{{ old('name', $user->name) }}" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="email" class="col-sm-2 col-form-label">{{ __('E-mail') }}</label>
                <div class="col-sm-5">
                    <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @endif" value="{{ old('email', $user->email) }}" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="roles" class="col-sm-2 col-form-label">{{ __('Roles') }}</label>
                <div class="col-sm-10">
                    @foreach ($roles as $role)
                        <div class="row">
                            <div class="col">
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input
                                        class="custom-control-input"
                                        id="role-{{ $role->id }}"
                                        type="checkbox"
                                        value="{{ $role->id }}"
                                        name="roles[]"
                                        @if(in_array($role->id, old('roles') ?? $userRoles))
                                            checked
                                        @endif
                                    />
                                    <label class="custom-control-label" for="role-{{ $role->id }}">
                                        <span class="text-muted">{{ $role->name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-right">
                <a href="{{ route('admin.users.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

