@if($user->isVerified())
    @if (auth()->id() === $user->id || !auth()->user()->can('unconfirm verification user'))
        <span class='badge badge-success'>{{ __('Yes') }}</span>
    @else
        <a
            href="javascript:;"
            data-submit-method="POST"
            data-submit-cancel="true"
            data-submit-action="{{ route('admin.users.unconfirm-email-verification', $user) }}"
        >
            <span class='badge badge-success'>{{ __('Yes') }}</span>
        </a>
    @endif
@else
    @if (auth()->id() === $user->id || !auth()->user()->can('confirm verification user'))
        <span class='badge badge-danger'>{{ __('No') }}</span>
    @else
        <a
            href="javascript:;"
            data-submit-method="POST"
            data-submit-cancel="true"
            data-submit-action="{{ route('admin.users.confirm-email-verification', $user)  }}"
        >
            <span class='badge badge-danger'>{{ __('No') }}</span>
        </a>
    @endif
@endif
