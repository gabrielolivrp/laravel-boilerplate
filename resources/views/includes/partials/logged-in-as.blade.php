@impersonating
<div class="alert alert-warning pt-1 pb-1 mb-0">
    {{ __('You are currently logged in as :name.', ['name' => auth()->user()->name]) }} <a href="{{ route('impersonate.leave') }}">{{ __('Return to your account') }}</a>.
</div><!--alert alert-warning-->
@endImpersonating
