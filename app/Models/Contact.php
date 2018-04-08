<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

	protected $fillable = [
        'name', 'email', 'phone', 'content', 'created_at'
    ];

    public $timestamps=false;

}
