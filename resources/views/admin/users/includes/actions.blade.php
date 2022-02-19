<div class="btn-group" role="group" aria-label="{{ __('Actions') }}">
    @if ($user->trashed())
        @can('restore user')
            <a
                href="javascript:;"
                class="border-0 btn-transition btn btn-outline-success"
                data-toggle="tooltip"
                data-original-title="{{ __('Restore user') }}"
                data-submit-method="POST"
                data-submit-cancel="true"
                data-submit-action="{{ route('admin.users.restore', $user) }}"
            >
                <i class="fas fa-sync"></i>
            </a>
        @endcan
        @can('delete permanently user')
            <a
                href="javascript:;"
                class="border-0 btn-transition btn btn-outline-danger"
                data-toggle="tooltip"
                data-original-title="{{ __('Delete permanently') }}"
                data-submit-method="DELETE"
                data-submit-cancel="true"
                data-submit-action="{{ route('admin.users.permanently-delete', $user) }}"
            >
                <i class="fas fa-trash"></i>
            </a>
        @endcan
    @else
        @can('view user')
            <a
                href="{{ route('admin.users.show', $user) }}"
                class="border-0 btn-transition btn btn-outline-primary"
                data-toggle="tooltip"
                data-original-title="{{ __('Show user') }}"
            >
                <i class="fas fa-eye"></i>
            </a>
        @endcan
        @can('update user')
            <a
                href="{{ route('admin.users.edit', $user) }}"
                class="border-0 btn-transition btn btn-outline-warning"
                data-toggle="tooltip"
                data-original-title="{{ __('Edit user') }}"
            >
                <i class="fas fa-edit"></i>
            </a>
        @endcan
        <button
            type="button"
            class="border-0 btn-transition btn btn-outline-info"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                @if($user->id !== auth()->id())
                    @can('delete user')
                        <a
                            href="javascript:;"
                            data-toggle="tooltip"
                            data-submit-method="DELETE"
                            data-submit-cancel="true"
                            data-submit-action="{{ route('admin.users.destroy', $user) }}"
                            class="dropdown-item"
                        >
                            {{ __('Delete')  }}
                        </a>
                    @endif

                    @if (!$user->isVerified())
                        @can('resend email verification user')
                            <a
                                href="javascript:;"
                                data-toggle="tooltip"
                                data-submit-method="POST"
                                data-submit-cancel="true"
                                data-submit-action="{{ route('admin.users.resend-email-verification', $user) }}"
                                class="dropdown-item"
                            >
                                {{ __('Resend verification email')  }}
                            </a>
                        @endcan
                    @endif

                    @canBeImpersonated($user)
                        <a
                            href="{{ route('impersonate', $user) }}"
                            class="dropdown-item"
                        >
                            {{ __('Login as :name', ['name' => $user->name]) }}
                        </a>
                    @endCanBeImpersonated

                    @if($user->isActive())
                        @can('deactivate user')
                            <a
                                href="javascript:;"
                                data-toggle="tooltip"
                                data-submit-method="POST"
                                data-submit-cancel="true"
                                data-submit-action="{{ route('admin.users.deactivate', $user) }}"
                                class="dropdown-item"
                            >
                                {{ __('Deactivate')  }}
                            </a>
                        @endcan
                    @else
                        @can('reactivate user')
                            <a
                                href="javascript:;"
                                data-toggle="tooltip"
                                data-submit-method="POST"
                                data-submit-cancel="true"
                                data-submit-action="{{ route('admin.users.reactivate', $user) }}"
                                class="dropdown-item"
                            >
                                {{ __('Reactivate')  }}
                            </a>
                        @endcan
                    @endif
                @endif

                @can('change password user', $user)
                    <a href="{{ route('admin.users.change-password', $user)  }}" class="dropdown-item">{{ __('Change password') }}</a>
                @endif
            </div>
    @endif
</div>
