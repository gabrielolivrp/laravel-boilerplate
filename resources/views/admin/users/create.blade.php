@extends('layouts.admin')

@section('title', __('Users - Create'))

@section('content')
<div class="main-card mb-3 card">

    <div class="card-header">
        <div>{{ __('User') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="position-relative row form-group">
                <label for="name" class="col-sm-2 col-form-label">{{ __('Full name') }}</label>
                <div class="col-sm-4">
                    <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @endif" value="{{ old('name') }}" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="email" class="col-sm-2 col-form-label">{{ __('E-mail') }}</label>
                <div class="col-sm-4">
                    <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @endif" value="{{ old('email') }}" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="password" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                <div class="col-sm-2">
                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @endif" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label for="password_confirmation" class="col-sm-2 col-form-label">{{ __('Confirm password') }}</label>
                <div class="col-sm-2">
                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" @error('password') is-invalid @endif" />
                </div>
            </div>

            <div class="position-relative row form-group">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input class="custom-control-input" id="active" type="checkbox" value="1" name="active" {{ old('active') || !old('active') ? 'checked' : '' }} />
                        <label class="custom-control-label" for="active">
                            <span class="text-muted">{{ __('Active') }}</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="position-relative row form-group">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <div class="custom-checkbox custom-control custom-control-inline">
                        <input class="custom-control-input" id="send_confirmation_email" type="checkbox" value="1" name="send_confirmation_email" {{ old('send_confirmation_email') ? 'checked' : '' }} />
                        <label class="custom-control-label" for="send_confirmation_email">
                            <span class="text-muted">{{ __('Send confirmation email') }}</span>
                        </label>
                    </div>
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
                                        @if(in_array($role->id, old('roles') ?? []))
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
                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

