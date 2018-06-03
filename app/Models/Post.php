<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS = [
        'processing' => 0,
        'processed' => 1,
        'cancel' => 2,
    ];

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

    protected $table = 'posts';

	protected $fillable = [
        'name', 'description', 'direction', 'cat_id', 'images', 'status', 'village_id', 'street_id', 'district_id', 'project', 'area', 'view', 'price', 'unit_price_id', 'frontispiece', 'road_ahead', 'number_of_floor', 'number_of_room', 'number_of_toilet', 'furniture', 'poster_id', 'deleted_at', 'info_contact', 'start_time', 'end_time', 'created_at', 'map'
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

    //  /**
    //  * Get street relationship
    //  */
    // public function typePost()
    // {
    //     return $this->belongsTo('App\Models\TypePost', 'type_post_id', 'id');
    // }

    /**
     * Get ratingProducts relationship
     */
    public function getDirectionAttribute($value)
    {
        return $this::DIRECTION[$value];
    }
}
