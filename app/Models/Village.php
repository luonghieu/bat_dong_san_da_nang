<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $table = 'village';

	protected $fillable = [
        'name', 'district_id'
    ];

    public $timestamps=false;

    /**
     * Get district relationship
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
        return $this->hasMany('App\Models\Product', 'village_id', 'id');
    }
}
