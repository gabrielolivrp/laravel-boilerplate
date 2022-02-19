@if($user->isActive())
    <span class='badge badge-success'>{{ __('Active') }}</span>
@else
    <span class='badge badge-danger'>{{ __('Inactive') }}</span>
@endif
