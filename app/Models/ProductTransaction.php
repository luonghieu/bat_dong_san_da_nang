<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $table = 'product_transaction';

    const PAYED = [
        'yes' => 1,
        'no' => 0,
    ];

	protected $fillable = [
        'customer_id', 'product_id', 'type_post_id', 'created_at', 'published', 'end_day', 'active', 'payed'
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

     /**
     * Get typePost relationship
     */
    public function typePost()
    {
        return $this->belongsTo('App\Models\TypePost', 'type_post_id', 'id');
    }
}
