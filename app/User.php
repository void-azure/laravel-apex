<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Scout\Searchable;

/**
 * The user model.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, Billable, Searchable;

    /** @var array $casts The attributes that should be cast to native types. */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'email', 'rating', 'username', 'password',
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
