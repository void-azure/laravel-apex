<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The permission model.
 */
class Permission extends Model
{
    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'display', 'description',
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
