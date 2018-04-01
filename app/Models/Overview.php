<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
	const TYPEPRODUCT = [
        'Đất nền','Nhà phố','Biệt thự'
    ];

    protected $table = 'overviews';

	protected $fillable = [
        'contractor', 'area', 'type_product', 'detail_product'
    ];

    public $timestamps=false;

    /**
     * Get detailProject relationship
     */
    public function detailProject()
    {
        return $this->hasOne('App\Models\DetailProject', 'overview_id', 'id');
    }
}
