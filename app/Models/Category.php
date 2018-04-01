<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const TYPETRANSACTION = [
        'sale' => 1,
        'lease' => 2,
    ];

    protected $table = 'categories';

	protected $fillable = [
        'name', 'type_transaction'
    ];

    public $timestamps=false;

    /**
     * Get products relationship
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id');
    }
}
