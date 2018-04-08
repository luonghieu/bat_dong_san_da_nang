<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    
    protected $table = 'schedules';

	protected $fillable = [
        'employee_id', 'content', 'time', 'is_done'
    ];

    public $timestamps=false;


    /**
     * Get type customer relationship
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }
}
