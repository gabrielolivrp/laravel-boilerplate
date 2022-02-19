@canany(['reactivate user'])
<a href="{{ route('admin.users.deactivated') }}" class="c-subheader-nav-link">{{ __('Deactivated') }}</a>
@endcan
@canany(['permanently delete user', 'restore user'])
<a href="{{ route('admin.users.deleted') }}" class="c-subheader-nav-link">{{ __('Deleted') }}</a>
@endcan
