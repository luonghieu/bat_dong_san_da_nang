<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

	protected $fillable = [
        'name', 'email', 'phone', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get servedByEmployee relationship
     */
    public function servedByEmployee()
    {
        return $this->hasMany('App\Models\AssignTask', 'customer_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function registers()
    {
        return $this->hasMany('App\Models\Register', 'customer_id', 'id');
    }


    /**
     * Get rating relationship
     */
    public function rating()
    {
        return $this->hasMany('App\Models\RatingCustomer', 'customer_id', 'id');
    }

}
