<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    const TYPECUSTOMER = [
        'post' => 1,
        'purchase' => 2,
        'contractor' => 3,
    ];

    protected $table = 'customers';

	protected $fillable = [
        'name', 'address', 'phone', 'created_at', 'type_customer', 'user_id', 'active'
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
     * Get servedByEmployee relationship
     */
    public function servedByEmployee()
    {
        return $this->hasOne('App\Models\AssignTask', 'customer_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function productTransaction()
    {
        return $this->hasMany('App\Models\ProductTransaction', 'customer_id', 'id');
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
        return $this->hasOne('App\Models\RatingCustomer', 'customer_id', 'id');
    }

    /**
     * Get ratingProducts relationship
     */
    public function ratingProducts()
    {
        return $this->hasMany('App\Models\RatingProduct', 'customer_id', 'id');
    }
}
