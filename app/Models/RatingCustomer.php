<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingCustomer extends Model
{
    const LEVEL = [
        'normal' => 1,
        'potential' => 2,
        'verypotential' => 3,
    ];

    protected $table = 'rating_customer';

	protected $fillable = [
        'customer_id', 'employee_id', 'level', 'comment', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get customer relationship
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }

    /**
     * Get employee relationship
     */
    public function employee()
    {
        return $this->belongsTo('App\Models\Employee', 'employee_id', 'id');
    }
}
