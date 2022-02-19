<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfileInformation">

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" wire:model.defer="state.name" class="form-control @error('name') is-invalid @enderror" />
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        @if ($this->user->canChangeEmail())
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" name="email" wire:model.defer="state.email" class="form-control @error('email') is-invalid @enderror" />
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>
</div>
