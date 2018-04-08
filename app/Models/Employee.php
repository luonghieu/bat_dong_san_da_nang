<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    const GENDER = [
        'male' => 0,
        'female' => 1,
    ];

    protected $table = 'employees';

	protected $fillable = [
        'name', 'gender', 'address', 'phone', 'user_id'
    ];

    public $timestamps=false;

    /**
     * Get user relationship
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get tasks relationship
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\AssignTask', 'employee_id', 'id');
    }

    /**
     * Get rating relationship
     */
    public function rating()
    {
        return $this->hasMany('App\Models\RatingCustomer', 'employee_id', 'id');
    }
}
