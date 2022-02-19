
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @foreach(collect(config('boilerplate.locale.languages'))->sortBy('name') as $code => $details)
        @if($code !== app()->getLocale())
            <a class="dropdown-item pt-1 pb-1" href="{{ route('locale.store', $code) }}">
                {{ __(getLocaleName($code)) }}
            </a>
        @endif
    @endforeach
</div><!--dropdown-menu-->
