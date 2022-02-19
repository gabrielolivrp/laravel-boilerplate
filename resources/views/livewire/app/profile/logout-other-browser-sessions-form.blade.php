<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-info">
        {{ __('If necessary, you may logout of all of your other browser sessions across all of your devices. Some of your recent
               sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised,
               you should also update your password.') }}
    </div>

    @if (count($this->sessions) > 0)
        <div class="mt-5 mb-3">
            @foreach ($this->sessions as $session)
                <div class="d-flex @if(! $loop->last) mb-3 @endif">
                    <div>
                        @if ($session->agent->isDesktop())
                            <i class="fas fa-desktop"></i>
                        @else
                            <i class="fas fa-mobile-alt"></i>
                        @endif
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                @else
                                    {{ __('Last active') }} {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-confirm-password">{{ __('Logout other browser sessions') }}</button>

    <div class="modal" id="modal-confirm-password" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Logout other browser sessions') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" name="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel')}}</button>
                    <button type="button" class="btn btn-primary" wire:click="logoutOtherBrowserSessions">{{ __('Logout other browser sessions') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('loggedOut', () => {
        document.getElementById('btn-close').click();
    });
</script>
@endpush

