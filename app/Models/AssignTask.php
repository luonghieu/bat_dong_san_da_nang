<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
	protected $table = 'assign_task';

	protected $fillable = [
        'employee_id', 'customer_id', 'created_at', 'assigner_id', 'assigner_role'
    ];

    public $timestamps=false;

    const ROLE = [
        'admin' => 1,
        'leader' => 2,
    ];

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
    public function customer()
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

    /**
     * Get assignedBy relationship
     */
    public function assignedByAdmin()
    {
        return $this->belongsTo('App\Models\User', 'assigner_id', 'id')->where('role', $this::ROLE['admin']);
    }

    /**
     * Get assignedBy relationship
     */
    public function assignedByLeader()
    {
        return $this->belongsTo('App\Models\Employee', 'assigner_id', 'id');
    }

}
