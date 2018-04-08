<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

	protected $fillable = [
        'name', 'email', 'phone', 'address'
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
    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction', 'customer_id', 'id');
    }

    /**
     * Get purchaseTransaction relationship
     */
    public function purchaseTransaction()
    {
        return $this->hasMany('App\Models\PurchaseTransaction', 'customer_id', 'id');
    }

    /**
     * Get rating relationship
     */
    public function rating()
    {
        return $this->hasMany('App\Models\RatingCustomer', 'customer_id', 'id');
    }

}
