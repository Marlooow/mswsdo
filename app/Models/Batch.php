<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'name',
        'social_worker_id',
        'release_date',
        'status',
        'amount',
        'remarks',
    ];

    protected $casts = [
        'release_date' => 'datetime',
    ];
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'batch_id', 'id');
    }

    public function socialWorker()
    {
        return $this->belongsTo(User::class, 'social_worker_id');
    }
}
