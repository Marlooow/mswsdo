<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'program_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isSocialWorker()
    {
        return $this->hasRole('social_worker');
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('super_admin');
    }

    public function beneficiaries()
    {
        if ($this->isSocialWorker()) {
            return $this->hasMany(Beneficiary::class, 'social_worker_id');
        }
        return null;
    }
    public static function getAdminForProgram($programId)
    {
        return User::where('program_id', $programId)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->first();
    }
}
