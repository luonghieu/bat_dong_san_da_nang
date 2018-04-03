<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    protected $table = 'street';

	protected $fillable = [
        'name', 'district_id'
    ];

    public $timestamps=false;

    /**
     * Get type district relationship
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }

    /**
     * Get products relationship
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'street_id', 'id');
    }
}