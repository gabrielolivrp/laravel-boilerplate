@if ($user->isEnableTwoFactor())
    <span class="badge badge-success" data-toggle="tooltip">{{ __('Yes') }}</span>
@else
    <span class="badge badge-danger">{{ __('No') }}</span>
@endif
