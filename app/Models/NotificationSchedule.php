<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSchedule extends Model
{
    const RECURRING_TYPES = [
        'daily' => 1,
        'weekly' => 2,
        'monthly' => 3,
    ];

    const TYPES = [
        'customer' => 1,
        'employee' => 2,
    ];

    const STATUS = [
        'progressing' => 1,
        'done' => 2,
    ];

    protected $fillable = [
        'title',
        'content',
        'type',
        'is_recurring',
        'recurring_type',
        'date_of_week',
        'day_of_month',
        'send_date',
        'send_time',
        'status',
    ];
}