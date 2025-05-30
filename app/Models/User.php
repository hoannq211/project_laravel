<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address'
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
        'password' => 'hashed',
    ];

    public function roles () {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function uploadFiles () {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
    public function hasAnyRole ($roleNames) {
        if(is_array($roleNames)){
            return $this->roles()->whereIn('name', $roleNames)->exists();
        }

        return $this->roles()->where('name', $roleNames)->exists();
    }
    public function isAdmin () {
        return $this->hasRole('admin');
    }
    public function isStaff () {
        return $this->hasAnyRole(['Nhân Viên','tạp vụ','Quản lý']);
    }
}
