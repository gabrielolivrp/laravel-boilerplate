<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('user-profile-information.index', fn (Trail $trail) =>
    $trail
        ->parent('home')
        ->push(__('Profile'), route('user-profile-information.index'))
);
