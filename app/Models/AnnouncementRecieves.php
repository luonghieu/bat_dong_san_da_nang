<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementRecieves extends Model
{
    protected $table = 'announcement_recieves';

	protected $fillable = [
        'announcement_id', 'reciever_id','is_read'
    ];

    public $timestamps=false;

    /**
     * Get products relationship
     */
    public function announcement()
    {
        return $this->belongsTo('App\Models\Announcement', 'announcement_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'reciever_id', 'id');
    }

}
