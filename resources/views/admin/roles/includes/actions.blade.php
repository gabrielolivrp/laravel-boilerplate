<div class="btn-group" role="group" aria-label="{{ __('Actions') }}">
    @can('update role')
        <a
            href="{{ route('admin.roles.edit', $role) }}"
            class="border-0 btn-transition btn btn-outline-warning"
            data-toggle="tooltip"
            data-original-title="{{ __('Edit role') }}"
        >
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    @can('delete role')
        <a
            href="javascript:;"
            class="border-0 btn-transition btn btn-outline-danger"
            data-toggle="tooltip"
            data-original-title="{{ __('Delete role') }}"
            data-submit-method="DELETE"
            data-submit-action="{{ route('admin.roles.destroy', $role) }}"
            data-submit-cancel="true"
        >
            <i class="fas fa-trash"></i>
        </a>
    @endcan
</div>
