<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePost extends Model
{

    protected $table = 'type_post';

	protected $fillable = [
        'name', 'start_time', 'end_time', 'price'
    ];

    public $timestamps=false;

}
