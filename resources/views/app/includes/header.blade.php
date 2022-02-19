<header class="c-header c-header-light c-header-fixed">
    <a class="c-header-brand" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/coreui.svg#full') }}"></use>
        </svg>
    </a>
    <ul class="c-header-nav d-md-down-none">

        @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
            <li class="nav-item dropdown">
                <a
                    class="nav-link dropdown-toggle"
                    id="navbarDropdownLanguageLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{ __(getLocaleName(app()->getLocale())) }}
                </a>

                @include('includes.partials.lang')
            </li>
        @endif
    </ul>


    <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown">

            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->email ?? '' }}">
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                @can('access admin')
                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                @endcan
                <a class="dropdown-item" href="{{ route('user-profile-information.index') }}">
                    {{ __('Profile') }}
                </a>
                <button
                    type="button"
                    tabindex="0"
                    class="dropdown-item"
                    data-submit-method="POST"
                    data-submit-action="{{ route('logout') }}"
                >
                    {{ __('Logout') }}
                </button>
            </div>
        </li>
    </ul>

    <div class="c-subheader justify-content-between px-3">
        @include('includes.breadcrumbs')

        <div class="c-subheader-nav mfe-2">
            @yield('breadcrumb-links')
        </div>
    </div><!--c-subheader-->
</header>
