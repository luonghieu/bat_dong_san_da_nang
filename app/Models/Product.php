<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

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
        'project_id', 'block', 'floor', 'apartment', 'price', 'area', 'description', 'land',' view', 'direction', 'unit_price_id', 'cat_id', 'status', 'images'
    ];

    public $timestamps=false;

    /**
     * Get cat relationship
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

     /**
     * Get street relationship
     */
     public function unitPrice()
     {
        return $this->belongsTo('App\Models\UnitPrice', 'unit_price_id', 'id');
    }

     /**
     * Get cat relationship
     */
     public function cat()
     {
        return $this->belongsTo('App\Models\Category', 'cat_id', 'id');
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
