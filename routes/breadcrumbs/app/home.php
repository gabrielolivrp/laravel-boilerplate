<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('home', fn (Trail $trail) =>
    $trail->push(__('Home'), route('home'))
);

