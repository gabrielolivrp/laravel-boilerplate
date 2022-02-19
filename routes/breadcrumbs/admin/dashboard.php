<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('admin.dashboard', fn (Trail $trail) =>
    $trail->push(__('Dashboard'), route('admin.dashboard'))
);
