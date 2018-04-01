<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProject extends Model
{
    protected $table = 'detail_projects';

	protected $fillable = [
        'overview_id', 'position_id', 'utilities', 'progress'
    ];

    public $timestamps=false;


    /**
     * Get type customer relationship
     */
    public function overView()
    {
        return $this->belongsTo('App\Models\OverView', 'overview_id', 'id');
    }

    /**
     * Get user relationship
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'position_id', 'id');
    }

     /**
     * Get project relationship
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'detail_project_id', 'id');
    }
}
