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
    
    protected $fillable = [
        'project_id', 'block', 'floor', 'price', 'area', 'description', 'land',' view', 'direction'
    ];

    public $timestamps=false;

    /**
     * Get cat relationship
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

}
