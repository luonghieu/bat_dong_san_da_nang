<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const STATUS = [
        'ready' => 1,
        'saling' => 2,
        'comingsoon' => 3,
        'stop' => 4,
    ];

    protected $table = 'projects';

	protected $fillable = [
        'name', 'detail_project_id', 'view', 'status', 'image', 'created_at', 'library_images', 'district_id', 'village_id', 'street_id', 'map'
    ];

    public $timestamps=false;

    /**
     * Get detailProject relationship
     */
    public function detailProject()
    {
        return $this->belongsTo('App\Models\DetailProject', 'detail_project_id', 'id');
    }

      /**
     * Get village relationship
     */
    public function village()
    {
        return $this->belongsTo('App\Models\Village', 'village_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function street()
    {
        return $this->belongsTo('App\Models\Street', 'street_id', 'id');
    }

    /**
     * Get street relationship
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }

    //  /**
    //  * Get detailProject relationship
    //  */
    // public function getStatusAttribute($value)
    // {
    //     switch ($value) {
    //         case 1:
    //             return 'ready';
    //         case 2:
    //             return 'saling';
    //         case 3:
    //             return 'comingsoon';
            
    //     }
    // }
}
