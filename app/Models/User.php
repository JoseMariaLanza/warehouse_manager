<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use HasPermissions;

    protected $connection = 'core';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function userRoles()
    {
        return $this->hasMany('model_has_roles', 'model_id');
    }

    function userPermissions()
    {
        return $this->hasMany('model_has_permissions', 'model_id');
    }

    public function scopeUserRoles($query)
    {
        return $this->getRoleNames();
        // return $query->join('model_has_roles', 'users.id', 'model_has_roles.model_id');
        // return $query->with(['roles']);
        // return $query->join('roles', 'model_has_roles.model_id', 'users.id');
        // return $this->where('email', function ($query) {
        //     return $this->where('id', $query->id);
        // });
    }
}
