<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

	protected $fillable = [
        'customer_id', 'project_id', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get user relationship
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\customer', 'customer_id', 'id');
    }

    /**
     * Get productTransaction relationship
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

}
