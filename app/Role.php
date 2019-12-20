<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * The role model.
 */
class Role extends Model
{
    use Searchable;

    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'display', 'description',
    ];

    /**
     * The relationship between the user model.
     *
     * @return mixed Returns the relationship.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * The relationship between the permission model.
     *
     * @return mixed Returns the relationship.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    /**
     * Check to see if the role has a permission.
     *
     * @param mixed $permission The permission to check against.
     *
     * @return bool Returns true if the role has permission and false if not.
     */
    public function hasPermission($permission)
    {
        if (is_array($permission)) {
            return null !== $this->permissions()->whereIn('name', $permission)->first();
        }
        return null !== $this->permissions()->where('name', $permission)->first();
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed Returns anything.
     */
    public function getScoutKey()
    {
        return $this->name;
    }

    /**
     * Get the key name used to index the model.
     *
     * @return mixed Returns anything.
     */
    public function getScoutKeyName()
    {
        return 'name';
    }
}
