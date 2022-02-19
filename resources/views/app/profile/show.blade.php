@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="text-center">
                            <form action="{{ route('user-profile-information.upload-profile-photo') }}" method="POST" id="upload-photo-form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="file" id="avatar-input" name="photo" class="d-none" />
                            </form>
                            <img src="{{ auth()->user()->profile_photo_url }}"  class="rounded-circle" id="avatar-preview" style="width: 100px; height: 100px; cursor: pointer;"/>
                        </div>
                        <div class="text-center mt-3">
                            @if (auth()->user()->profile_photo_path)
                                <button
                                    type="button"
                                    data-toggle="tooltip"
                                    data-submit-method="PUT"
                                    data-submit-cancel="true"
                                    data-submit-action="{{ route('user-profile-information.delete-profile-photo') }}"
                                    class="btn btn-default"
                                >
                                    {{ __('Remove Photo') }}
                                </button>
                            @endif
                        </div>
                    </div>
                    <h5 class="card-title">{{ __('Menu') }}</h5>
                    <ul class="nav nav-pills flex-column" id="menu-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active"  data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">{{ __('Profile')  }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="change-password-tab" data-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="false">{{ __('Change password') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-factor-authentication-tab" data-toggle="tab" href="#two-factor-authentication" role="tab" aria-controls="two-factor-authentication" aria-selected="false">{{ __('Two factor authentication') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="logout-other-browser-sessions-tab" data-toggle="tab" href="#logout-other-browser-sessions" role="tab" aria-controls="logout-other-browser-sessions" aria-selected="false">{{ __('Browser sessions') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="delete-user-tab" data-toggle="tab" href="#delete-user" role="tab" aria-controls="delete-user" aria-selected="false">{{ __('Delete my account') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="menu-tabs-content">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @livewire('app.profile.update-profile-information-form')
                        </div>
                        <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                            @livewire('app.profile.update-password-form')
                        </div>
                        <div class="tab-pane fade" id="two-factor-authentication" role="tabpanel" aria-labelledby="two-factor-authentication-tab">
                            @livewire('app.profile.two-factor-authentication-form')
                        </div>
                        <div class="tab-pane fade" id="logout-other-browser-sessions" role="tabpanel" aria-labelledby="logout-other-browser-sessions-tab">
                            @livewire('app.profile.logout-other-browser-sessions-form')
                        </div>
                        <div class="tab-pane fade" id="delete-user" role="tabpanel" aria-labelledby="delete-user-tab">
                            @livewire('app.profile.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('avatar-preview').addEventListener('click', function() {
        document.getElementById('avatar-input').click();
    });

    document.getElementById('avatar-input').addEventListener('change', function(event) {
        document.getElementById('upload-photo-form').submit();
    });
</script>
@endpush
