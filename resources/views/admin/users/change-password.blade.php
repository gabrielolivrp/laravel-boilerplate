@extends('layouts.admin')

@section('title', __('Users - Change password'))

@section('content')
    <div class="main-card mb-3 card">

        <div class="card-header">
            <div>{{ __('User') }}</div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.users.change-password.update', $user) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="position-relative row form-group">
                    <label for="first_name" class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                    <div class="col-sm-4">
                        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @endif" />
                    </div>
                </div>

                <div class="position-relative row form-group">
                    <label for="last_name" class="col-sm-2 col-form-label">{{ __('Confirm password') }}</label>
                    <div class="col-sm-4">
                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" />
                    </div>
                </div>

            <div class="text-right">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-link">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

