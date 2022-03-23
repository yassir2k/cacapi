<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_organizations';
    protected $primaryKey = 'id';
    public $timestamps  = false;
    protected $fillable = [
        'username',
        'email',
        'organization_name',
        'address',
        'contact_name',
        'contact_phone',
        'password',
        'is_active',
        'is_registered',
        'registered_on',
        'registration_hash',
        'password_reset_hash',
        'password_hash_control',
        'units',
        'role'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'registration_hash',
        'password_reset_hash',
        'password_hash_control'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
