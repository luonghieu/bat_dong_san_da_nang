<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $table = 'posters';

	protected $fillable = [
        'name', 'address', 'phone', 'created_at', 'user_id'
    ];

    public $timestamps=false;

    /**
     * Get user relationship
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'poster_id', 'id');
    }

}
