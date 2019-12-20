<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * The permission model.
 */
class Permission extends Model
{
    use Searchable;

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
