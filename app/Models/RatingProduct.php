<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingProduct extends Model
{
    const LEVEL = [
        'normal' => 1,
        'potential' => 2,
        'verypotential' => 3,
    ];

    protected $table = 'rating_product';

	protected $fillable = [
        'product_id', 'customer_id', 'level', 'comment', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get product relationship
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    /**
     * Get customer relationship
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
