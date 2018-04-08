<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

	protected $fillable = [
        'project_id', 'block', 'floor', 'price', 'area'
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
