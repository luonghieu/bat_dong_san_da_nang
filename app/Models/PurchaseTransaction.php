<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseTransaction extends Model
{
    protected $table = 'purchase_transaction';

	protected $fillable = [
        'customer_id', 'product_id', '	created_at', 'deposit', 'payment'
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
