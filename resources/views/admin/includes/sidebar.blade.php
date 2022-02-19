<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/coreui.svg#signet') }}"></use>
        </svg>
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.dashboard') }}" class="c-sidebar-nav-link {{ activeClass(Route::is('admin.dashboard'), 'c-active') }}">
                <i class="c-sidebar-nav-icon fas fa-tachometer-alt"></i>
                {{ __('Dashboard') }}
            </a>
        </li>
        @canany([
            'create user',
            'update user',
            'delete user',
            'restore user',
            'permanently delete user',
            'change password user',
            'deactivate user',
            'reactivate user',
            'confirm verification user',
            'unconfirm verification user',
            'clear session user',
        ])
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link {{ activeClass(Route::is('admin.users.*'), 'c-active') }}">
                    <i class="c-sidebar-nav-icon fas fa-user"></i>
                    {{ __('Users') }}
                </a>
            </li>
        @endcanany

        @canany([
            'create role',
            'update role',
            'delete role',
        ])
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.roles.index') }}" class="c-sidebar-nav-link {{ activeClass(Route::is('admin.roles.*'), 'c-active') }}">
                    <i class="c-sidebar-nav-icon fas fa-tags"></i>
                    {{ __('Roles') }}
                </a>
            </li>
        @endcanany
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
