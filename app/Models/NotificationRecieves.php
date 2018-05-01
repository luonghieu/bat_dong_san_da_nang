<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRecieves extends Model
{
    protected $table = 'notification_recieves';

	protected $fillable = [
        'notification_id', 'customer_id'
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
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
