<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The room model.
 */
class Room extends Model
{
    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'message', 'room_id',
    ];
}
