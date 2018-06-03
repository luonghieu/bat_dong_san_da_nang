<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';

	protected $fillable = [
        'name'
    ];

    public $timestamps=false;

    /**
     * Get villages relationship
     */
    public function villages()
    {
        return $this->hasMany('App\Models\Village', 'district_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'district_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function employee()
    {
        return $this->hasMany('App\Models\Employee', 'district_id', 'id');
    }
}
