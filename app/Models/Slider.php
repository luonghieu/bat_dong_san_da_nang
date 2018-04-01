<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

	protected $fillable = [
        'name', 'link', 'image', 'active', 'created_at'
    ];

    public $timestamps=false;
}
