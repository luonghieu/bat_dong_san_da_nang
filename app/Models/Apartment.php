<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{

    protected $table = 'apartments';

    const DIRECTION = [
        0 => 'Không xác định',
        1 => 'Đông',
        2 => 'Tây',
        3 => 'Nam',
        4 => 'Bắc',
        5 => 'Đông Bắc',
        6 => 'Đông Nam',
        7 => 'Tây Bắc',
        8 => 'Tây Nam',
    ];

    const STATUS = [
        0 => 'Out of stock',
        1 => 'Remaining',
    ];

    protected $fillable = [
        'id', 'product_id', 'floor', 'position', 'description', 'price', 'unit_price_id', 'area', 'direction', 'status'
    ];

    public $timestamps=false;

    /**
     * Get cat relationship
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

     /**
     * Get street relationship
     */
     public function unitPrice()
     {
        return $this->belongsTo('App\Models\UnitPrice', 'unit_price_id', 'id');
    }

    /**
     * Get ratingProducts relationship
     */
    public function getDirectionAttribute($value)
    {
        return $this::DIRECTION[$value];
    }

     /**
     * Get ratingProducts relationship
     */
     public function getStatusAttribute($value)
     {
        return $this::STATUS[$value];
    }

}
