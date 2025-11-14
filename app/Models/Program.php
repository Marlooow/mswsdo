<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name',
        'program_type',
        'created_at',
        'updated_at'
    ];

    //relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
