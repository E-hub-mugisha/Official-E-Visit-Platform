<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'national_id',
        'phone',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    public function visitor()
    {
        return $this->hasOne(Visitor::class);
    }

    public function notifications()
    {
        return $this->hasMany(VisitNotification::class);
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }
    public function isGuard()
    {
        return $this->role === 'guard';
    }
    public function isVisitor()
    {
        return $this->role === 'visitor';
    }
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }
}
