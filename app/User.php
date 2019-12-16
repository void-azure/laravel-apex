<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

/**
 * The user model.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable;

    /** @var array $casts The attributes that should be cast to native types. */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /** @var array $hidden The attributes that should be hidden for arrays. */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The relationship between the role model.
     *
     * @return mixed Returns the relationship.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
