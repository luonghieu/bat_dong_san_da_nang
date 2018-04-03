<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const STATUS = [
        'ready' => 1,
        'deposited' => 2,
        'signed' => 3,
    ];

    const DIRECTION = [
        0 => 'Khong xac dinh',
        1 => 'Đông',
        2 => 'Tây',
        3 => 'Nam',
        4 => 'Bắc',
        5 => 'Đông Bắc',
        6 => 'Đông Nam',
        7 => 'Tây Bắc',
        8 => 'Tây Nam',
    ];

    protected $table = 'products';

	protected $fillable = [
        'name', 'feature', 'detail', 'direction', 'direction_note', 'cat_id', 'image', 'status', 'village_id', 'street_id', 'area', 'view', 'district_id'
    ];

    public $timestamps=false;

    /**
     * Get cat relationship
     */
    public function cat()
    {
        return $this->belongsTo('App\Models\Category', 'cat_id', 'id');
    }

    /**
     * Get village relationship
     */
    public function village()
    {
        return $this->belongsTo('App\Models\Village', 'village_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function street()
    {
        return $this->belongsTo('App\Models\Street', 'street_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function productTransaction()
    {
        return $this->hasOne('App\Models\ProductTransaction', 'product_id', 'id');
    }

    /**
     * Get purchaseTransaction relationship
     */
    public function purchaseTransaction()
    {
        return $this->hasMany('App\Models\PurchaseTransaction', 'product_id', 'id');
    }

    /**
     * Get ratingProducts relationship
     */
    public function ratingProducts()
    {
        return $this->hasMany('App\Models\RatingProduct', 'product_id', 'id');
    }

    /**
     * Get ratingProducts relationship
     */
    public function getDirectionAttribute($value)
    {
        return $this::DIRECTION[$value];
    }
}
