<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

/**
 * The user model.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Searchable;

    /** @var array $casts The attributes that should be cast to native types. */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'username', 'password', 'phone_number', 'two_factor', 'two_factor_code', 'two_factor_expiry',
    ];

    /** @var array $hidden The attributes that should be hidden for arrays. */
    protected $hidden = [
        'password', 'two_factor_code', 'remember_token',
    ];

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param \Illuminate\Notifications\Notification $notification The notification channel.
     *
     * @return string Returns the phone number.
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }
    /**
     * The relationship between the role model.
     *
     * @return mixed Returns the relationship.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * Check to see if the user has a role.
     *
     * @param mixed $role The role to check against.
     *
     * @return bool Returns true if the user has role and false if not.
     */
    public function hasRole($role)
    {
        if (is_array($role)) {
            return null !== $this->roles()->whereIn('name', $role)->first();
        }
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed Returns anything.
     */
    public function getScoutKey()
    {
        return $this->username;
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed Returns anything.
     */
    public function getScoutKeyName()
    {
        return 'username';
    }
}
