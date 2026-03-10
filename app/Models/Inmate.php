<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inmate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'inmate_number', 'first_name', 'last_name', 'date_of_birth',
        'gender', 'national_id', 'crime_category', 'admission_date',
        'expected_release_date', 'status', 'cell_block', 'notes',
    ];

    protected $casts = [
        'date_of_birth'          => 'date',
        'admission_date'         => 'date',
        'expected_release_date'  => 'date',
    ];

    public function visitRequests()
    {
        return $this->hasMany(VisitRequest::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}