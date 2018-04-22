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
    public function manager()
    {
        return $this->belongsTo('App\Models\Employee', 'reciever_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'reciever_id', 'id');
    }
}
