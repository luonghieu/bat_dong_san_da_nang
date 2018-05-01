<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public $timestamps = false;

    const ROLE = [
        'admin' => 1,
        'leader' => 2,
        'sale' => 3,
        'customer' => 4,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role', 'active', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get employee relationship
     */
    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'user_id', 'id');
    }

    /**
     * Get customer relationship
     */
    public function poster()
    {
        return $this->hasOne('App\Models\Poster', 'user_id', 'id');
    }
}
