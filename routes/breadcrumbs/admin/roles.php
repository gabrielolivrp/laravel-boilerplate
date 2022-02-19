<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('admin.roles.index', fn (Trail $trail) =>
    $trail->push(__('Roles'), route('admin.roles.index'))
);

Breadcrumbs::for('admin.roles.create', fn (Trail $trail) =>
    $trail
        ->parent('admin.roles.index')
        ->push(__('Create'), route('admin.roles.create'))
);

Breadcrumbs::for('admin.roles.edit', fn (Trail $trail, $user) =>
    $trail
        ->parent('admin.roles.index')
        ->push(__('Edit'), route('admin.roles.edit', $user))
);
