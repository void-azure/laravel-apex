<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The message model.
 */
class Message extends Model
{
    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'message', 'room_id',
    ];

    /**
     * The relationship between the user model.
     *
     * @return mixed Returns the relationship.
     */
    public function user()
    {
    	return $this->belongsToMany('App\User');
    }
}