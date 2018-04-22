<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    const TYPE = [
        'manager' => 1,
        'employee' => 2,
    ];

    protected $table = 'announcements';

	protected $fillable = [
        'title', 'content', 'type', 'is_send_all', 'active', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get products relationship
     */
    public function announcementRecieves()
    {
        return $this->hasMany('App\Models\AnnouncementRecieves', 'announcement_id', 'id');
    }
}
