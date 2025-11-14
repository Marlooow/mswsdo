<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'program_id',
        'social_worker_id',
        'status',
        'form_data',
        'remarks',
        'updated_by',
        'approval_date',
        'claim_status',
        'claim_date',
        'claimed_amount',
        'admin_id',
        'approved_date',
        'date_released'
    ];

    protected $casts = [
        'form_data' => 'array',
        'claim_date' => 'datetime',
    ];

    public function getProgramNameAttribute()
    {
        return $this->program ? $this->program->name : 'N/A';
    }
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function socialWorker()
    {
        return $this->belongsTo(User::class, 'social_worker_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function updatedBySocialWorker()
    {
        return $this->belongsTo(User::class, 'social_worker_id');
    }
    
}
