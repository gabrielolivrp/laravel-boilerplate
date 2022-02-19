<?php

namespace App\Models\Traits\Scope;

trait UserScope
{
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
    }

    public function scopeOnlyActive($query)
    {
        return $query->whereActive(true);
    }
}
