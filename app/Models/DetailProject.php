<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProject extends Model
{
    protected $table = 'detail_projects';

	protected $fillable = [
        'introduce', 'overview', 'position', 'utilities', 'progress', 'price_payment'
    ];

    public $timestamps=false;

    /**
     * Get project relationship
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'detail_project_id', 'id');
    }
}
