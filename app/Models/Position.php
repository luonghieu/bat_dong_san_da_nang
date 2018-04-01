<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    const DIRECTION = [
        1 => 'Đông',
        2 => 'Tây',
        3 => 'Nam',
        4 => 'Bắc',
    ];

    protected $table = 'position';

	protected $fillable = [
        'district_id', 'direction', 'direction_note'
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
     * Get detailProject relationship
     */
    public function detailProject()
    {
        return $this->hasOne('App\Models\DetailProject', 'position_id', 'id');
    }

}
