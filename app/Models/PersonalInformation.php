<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';

    protected $fillable = [
        'attribute', 'value', 'customer_id', 'created_at'
    ];

    public $timestamps=false;

    /**
     * Get servedByEmployee relationship
     */
    public function customer()
    {
        return $this->hasMany('App\Models\Customer', 'customer_id', 'id');
    }

}
