<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
	protected $table = 'assign_task';

	protected $fillable = [
        'employee_id', 'customer_id', 'created_at'
    ];

    public $timestamps=false;


    /**
     * Get employee relationship
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }

    /**
     * Get customer relationship
     */
    public function cusotmer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    /**
     * Get chat relationship
     */
    public function chat()
    {
        return $this->hasOne('App\Models\Chat', 'assign_task_id', 'id');
    }

    /**
     * Get customerService relationship
     */
    public function customerService()
    {
        return $this->hasOne('App\Models\CustomerService', 'assign_task_id', 'id');
    }

}
