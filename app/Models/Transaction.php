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
        'register_id', 'product_id', 'description', 'floor', 'created_at', 'status', 'rating'
    ];

    public $timestamps=false;

    /**
     * Get customer relationship
     */
    public function register()
    {
        return $this->belongsTo('App\Models\Register', 'register_id', 'id');
    }

    /**
     * Get product relationship
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
