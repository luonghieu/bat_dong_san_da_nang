<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
	protected $table = 'assign_task';

	protected $fillable = [
        'employee_id', 'customer_id', 'created_at', 'assigner_id', 'assigner_role', 'description'
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
     * Get assignedBy relationship
     */
    public function assigner()
    {
        return $this->belongsTo('App\Models\User', 'assigner_id', 'id');
    }
}
