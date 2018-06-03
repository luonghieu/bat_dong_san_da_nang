<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    protected $table = 'consults';
    const TYPE = [
        'post' => 1,
        'project' => 2,
    ];

	protected $fillable = [
        'name', 'email', 'phone', 'type', 'product_id', 'created_at', 'message', 'sub_product_id'
    ];

    public $timestamps=false;

    /**
     * Get user relationship
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'product_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'product_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'sub_product_id', 'id');
    }

}
