<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'national_id', 'first_name', 'last_name',
        'date_of_birth', 'gender', 'phone', 'address',
        'occupation', 'relationship_to_inmate',
        'id_document_photo', 'is_verified', 'is_blacklisted', 'blacklist_reason',
    ];

    protected $casts = [
        'date_of_birth'   => 'date',
        'is_verified'     => 'boolean',
        'is_blacklisted'  => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}