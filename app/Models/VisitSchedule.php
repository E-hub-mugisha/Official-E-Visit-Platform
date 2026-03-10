<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_request_id', 'scheduled_date', 'scheduled_time',
        'end_time', 'visit_room', 'check_in_status',
        'checked_in_at', 'checked_out_at', 'checked_in_by', 'guard_notes',
    ];

    protected $casts = [
        'scheduled_date'  => 'date',
        'checked_in_at'   => 'datetime',
        'checked_out_at'  => 'datetime',
    ];

    public function visitRequest()
    {
        return $this->belongsTo(VisitRequest::class);
    }

    public function checkedInBy()
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }
}