<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerService extends Model
{
    const TYPESERVICE = [
        'everyday' => 1,
        'once_aweek' => 2,
        'once_amonth' => 3,
        'custom_time' => 4,
    ];

    const DATEOFWEEK = [
        'monday' => 1,
        'tuesday' => 2,
        'wendnesday' => 3,
        'thursday' => 4,
        'friday' => 5,
        'saturday' => 6,
        'sunday' => 7,
    ];

    const REPEAT = [
        'yes' => 1,
        'no' => 0,
    ];
    
    protected $table = 'customer_service';

	protected $fillable = [
        'assign_task_id', 'type_service', 'note', 'date_of_week', 'day_of_month', 'send_date', 'send_time', 'repeat'
    ];

    public $timestamps=false;


    /**
     * Get type customer relationship
     */
    public function assignTask()
    {
        return $this->belongsTo('App\Models\AssignTask', 'assign_task_id', 'id');
    }
}
