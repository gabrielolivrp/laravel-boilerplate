<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('admin.users.index', fn (Trail $trail) =>
    $trail->push(__('Users'), route('admin.users.index'))
);

Breadcrumbs::for('admin.users.create', fn (Trail $trail) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Create'), route('admin.users.create'))
);

Breadcrumbs::for('admin.users.edit', fn (Trail $trail, $user) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Edit'), route('admin.users.edit', $user))
);

Breadcrumbs::for('admin.users.show', fn (Trail $trail, $user) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Show'), route('admin.users.show', $user))
);

Breadcrumbs::for('admin.users.change-password', fn (Trail $trail, $user) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Change password'), route('admin.users.change-password', $user))
);

Breadcrumbs::for('admin.users.deactivated', fn (Trail $trail) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Deactivated'), route('admin.users.deactivated'))
);

Breadcrumbs::for('admin.users.deleted', fn (Trail $trail) =>
    $trail
        ->parent('admin.users.index')
        ->push(__('Deleted'), route('admin.users.deleted'))
);
