<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const STATUS = [
        'ready' => 1,
        'saling' => 2,
        'comingsoon' => 3,
    ];

    protected $table = 'projects';

	protected $fillable = [
        'name', 'detail_project_id', 'view', 'status', 'image', 'created_at'
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
