<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePost extends Model
{
    const TYPEFREETIME = [
        'aweek' => 1,
        'amonth' => 2,
    ];

    protected $table = 'type_post';

	protected $fillable = [
        'name', 'type_free_time', 'price'
    ];

    public $timestamps=false;

    /**
     * Get productTransactions relationship
     */
    public function productTransactions()
    {
        return $this->hasMany('App\Models\ProductTransaction', 'type_post_id', 'id');
    }
}
