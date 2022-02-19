@extends('layouts.admin')

@section('title', __('Users - Show'))

@section('content')
<div class="main-card mb-3 card">

    <div class="card-header">
        <div>{{ __('User') }}</div>
    </div>

    <div class="card-body">
        <table
            class="table table-striped"
            style="width: 100%;"
        >
            <tr>
                <th>{{ __('Avatar') }}</th>
                <td>
                    <img src="{{ $user->profile_photo_url }}" class="img-fluid" style="width: 80px" />
                </td>
            </tr>
            <tr>
                <th>{{ __('Name') }}</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>{{ __('E-mail') }}</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th>{{ __('Active') }}</th>
                <td>@include('admin.users.includes.status', ['user' => $user])</td>
            </tr>
            <tr>
                <th>{{ __('Verified') }}</th>
                <td>@include('admin.users.includes.confirmed', ['user' => $user])</td>
            </tr>
            <tr>
                <th>{{ __('2FA') }}</th>
                <td>@include('admin.users.includes.2fa', ['user' => $user])</td>
            </tr>

            @isset($user->provider)
                <tr>
                    <th>{{ __('Provider') }}</th>
                    <td>{{ ucfirst($user->provider)  }}</td>
                </tr>
            @endisset
            <tr>
                <th>{{ __('Last login ip') }}</th>
                <td>{{ $user->last_login_ip ?? __('N/A') }}</td>
            </tr>
            <tr>
                <th>{{ __('Last login') }}</th>
                <td>
                    @if($user->last_login_at)
                        {{ $user->last_login_at->format('Y-m-d h:m:i') }}
                    @else
                        {{ __('N/A') }}
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection

