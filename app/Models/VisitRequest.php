<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'request_number', 'visitor_id', 'inmate_id',
        'preferred_date', 'preferred_time', 'relationship',
        'purpose', 'status', 'reviewed_by', 'reviewed_at',
        'rejection_reason', 'admin_notes', 'number_of_visitors',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'reviewed_at'    => 'datetime',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function inmate()
    {
        return $this->belongsTo(Inmate::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function schedule()
    {
        return $this->hasOne(VisitSchedule::class);
    }

    public function notifications()
    {
        return $this->hasMany(VisitNotification::class);
    }

    public function isPending()   { return $this->status === 'pending'; }
    public function isApproved()  { return $this->status === 'approved'; }
    public function isRejected()  { return $this->status === 'rejected'; }
    public function isCompleted() { return $this->status === 'completed'; }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->request_number = 'VR-' . strtoupper(uniqid());
        });
    }
}