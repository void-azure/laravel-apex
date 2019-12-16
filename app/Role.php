<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The role model.
 */
class Role extends Model
{
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
}
