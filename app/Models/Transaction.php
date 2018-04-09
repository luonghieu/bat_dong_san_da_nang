<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const STATUS = [
        'processing' => 0, //ky gui
        'registered' => 1, //ky gui
        'deposit' => 2,
        'payment' => 3,
    ];

    protected $table = 'transactions';

	protected $fillable = [
        'customer_id', 'product_id', 'description', 'block', 'floor', 'created_at', 'status'
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
     * Get product relationship
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
