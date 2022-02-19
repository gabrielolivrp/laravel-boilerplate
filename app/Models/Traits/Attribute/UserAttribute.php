<?php

namespace App\Models\Traits\Attribute;

use Illuminate\Support\Facades\Hash;

trait UserAttribute
{
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }
}
