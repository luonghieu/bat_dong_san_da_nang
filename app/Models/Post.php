<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS = [
        'processing' => 1,
        'processed' => 2,
        'cancel' => 3,
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

    protected $table = 'posts';

	protected $fillable = [
        'name', 'description', 'detail', 'direction', 'cat_id', 'image', 'status', 'village_id', 'street_id', 'district_id', 'project_id', 'area', 'view', 'price', 'unit_price_id', 'start_date', 'end_date', 'frontispiece', 'road_ahead', 'number_of_floor', 'number_of_room', 'number_of_toilet', 'furniture', 'poster_id', 'deleted_at'
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
     * Get street relationship
     */
    public function poster()
    {
        return $this->belongsTo('App\Models\Poster', 'poster_id', 'id');
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
}
