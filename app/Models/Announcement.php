<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    const TITLE = [
        'customer' => 'NEW CUSTOMER',
        'employee' => 'NEW TASK',
    ];

    const CONTENT = [
        'customer' => 'A new customer has just register',
        'employee' => 'Have a new task',
    ];


    protected $table = 'announcements';

	protected $fillable = [
        'title', 'content', 'active', 'created_at', 'causer_id'
    ];

    public $timestamps=false;

    /**
     * Get products relationship
     */
    public function announcementRecieves()
    {
        return $this->hasMany('App\Models\AnnouncementRecieves', 'announcement_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function user()
    {
        return $this->hasMany('App\Models\User', 'causer_id', 'id');
    }
}
