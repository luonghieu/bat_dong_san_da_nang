<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatNew extends Model
{
    protected $table = 'cat_new';

	protected $fillable = [
        'name', 'active'
    ];

    public $timestamps=false;

    /**
     * Get news relationship
     */
    public function news()
    {
        return $this->hasMany('App\Models\News', 'cat_new_id', 'id');
    }
}
