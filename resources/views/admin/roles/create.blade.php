@extends('layouts.admin')

@section('title', __('Roles - Create'))

@section('content')
<div class="main-card mb-3 card">

    <div class="card-header">
        <div>{{ __('Roles') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="position-relative row form-group">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                <div class="col-sm-6">
                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @endif" value="{{ old('name') }}" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="permissions" class="col-sm-2 col-form-label">{{ __('Permissions') }}</label>
                <div class="col-sm-10">
                    @foreach ($permissions as $permission)
                        <div class="row">
                            <div class="col">
                                <div class="custom-checkbox custom-control custom-control-inline">
                                    <input
                                        id="permission-{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                        class="custom-control-input"
                                        name="permissions[]"
                                        type="checkbox"
                                        @if(in_array($permission->id, old('permissions') ?? []))
                                            checked
                                        @endif
                                    />
                                    <label class="custom-control-label" for="permission-{{ $permission->id }}">
                                        <span class="text-muted">{{ $permission->name }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-right">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

