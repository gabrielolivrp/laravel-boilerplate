<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form  wire:submit.prevent="updatePassword">
        <div class="form-group">
            <label for="current_password">{{ __('Current password') }}</label>
            <input type="password" name="current_password" wire:model.defer="state.current_password" class="form-control @error('current_password') is-invalid @enderror" />
            @error('current_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('New password') }}</label>
            <input type="password" name="password" wire:model.defer="state.password" class="form-control @error('password') is-invalid @enderror" />
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm password') }}</label>
            <input type="password" name="password_confirmation" wire:model.defer="state.password_confirmation" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>
</div>
