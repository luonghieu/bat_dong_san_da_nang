<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

	protected $fillable = [
        'assign_task_id', 'message_customer', 'message_employee', 'created_at'
    ];

    public $timestamps=false;


    /**
     * Get assignTask relationship
     */
    public function assignTask()
    {
        return $this->belongsTo('App\Models\AssignTask', 'assign_task_id', 'id');
    }

}
