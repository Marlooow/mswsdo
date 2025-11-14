<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'first_name',
        'surname',
        'middle_name',
        'dob',
        'address',
        'email',
        'phone_number',
        'program',
        'program_id',
        'social_worker_id',
        'admin_id',
        'approved_date',
        'date_released',
        'status',
        'form_data',
        'name_extension',
        'place_of_birth',
        'sex',
        'civil_status'
    ];
    
    protected $casts = [
        'form_data' => 'array',
        'approved_date' => 'datetime',
        'date_released' => 'datetime',
    ];

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

    public function applications()
    {
        return $this->hasMany(Application::class, 'beneficiary_id', 'id');
    }
}
