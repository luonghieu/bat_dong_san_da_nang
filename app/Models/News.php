<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

	protected $fillable = [
        'name', 'feature', 'detail', 'created_at', 'view', 'active', 'cat_new_id', 'link', 'image'
    ];

    public $timestamps=false;

    /**
     * Get type district relationship
     */
    public function catNew()
    {
        return $this->belongsTo('App\Models\CatNew', 'cat_new_id', 'id');
    }
}
