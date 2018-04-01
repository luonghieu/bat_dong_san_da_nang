<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

	protected $fillable = [
        'name', 'describe', 'detail_project_id', 'view', 'status', 'image'
    ];

    public $timestamps=false;

    /**
     * Get detailProject relationship
     */
    public function detailProject()
    {
        return $this->belongsTo('App\Models\DetailProject', 'detail_project_id', 'id');
    }
}
