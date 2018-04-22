<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRecieves extends Model
{
    protected $table = 'notification_recieves';

	protected $fillable = [
        'notification_id', 'reciever_id','is_read'
    ];

    public $timestamps=false;

    /**
     * Get products relationship
     */
    public function notification()
    {
        return $this->belongsTo('App\Models\NotificationRecieves', 'notification_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'reciever_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'reciever_id', 'id');
    }
}
