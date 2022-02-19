<div>
    <div class="alert alert-info">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </div>

    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-delete-account">
        {{ __('Delete my account') }}
    </button>

    <div class="modal" id="modal-delete-account" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete account') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" name="password" wire:model.defer="password" wire:keydown.enter="deleteUser" class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel')}}</button>
                    <button type="button" class="btn btn-primary" wire:click="deleteUser">{{ __('Delete my account') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
