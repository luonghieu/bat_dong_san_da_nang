<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitPrice extends Model
{

    const TYPETRANSACTION = [
        'sale' => 1,
        'lease' => 2,
    ];

    protected $table = 'unit_price';

	protected $fillable = [
        'name', 'type_transaction'
    ];

    public $timestamps=false;

    /**
     * Get cat relationship
     */
    public function post()
    {
        return $this->hasMany('App\Models\Post', 'unit_price_id', 'id');
    }

}
