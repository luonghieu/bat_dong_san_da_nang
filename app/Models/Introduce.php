<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    protected $table = 'introduces';

	protected $fillable = [
        'name', 'description', 'active', 'created_at'
    ];

    public $timestamps=false;
}
