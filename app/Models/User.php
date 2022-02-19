<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;
use Lab404\Impersonate\Models\Impersonate;
use App\Models\Traits\HasUuid;
use App\Models\Traits\HasProfilePhoto;
use App\Models\Traits\Scope\UserScope;
use App\Models\Traits\Method\UserMethod;
use App\Models\Traits\Attribute\UserAttribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,
        Notifiable,
        SoftDeletes,
        TwoFactorAuthenticatable,
        HasRoles,
        HasUuid,
        Impersonate,
        HasProfilePhoto,
        UserAttribute,
        UserMethod,
        UserScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'active',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'last_login_at',
        'last_login_ip',
        'email_verified_at',
        'profile_photo_path',
        'provider',
        'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Return true or false if the user can impersonate an other user.
     *
     * @param void
     * @return  bool
     */
    public function canImpersonate(): bool
    {
        return $this->can('impersonate user');
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     * @return  bool
     */
    public function canBeImpersonated(): bool
    {
        return ! $this->isMasterAdmin();
    }
}
