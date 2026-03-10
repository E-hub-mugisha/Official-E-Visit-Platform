<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'visit_request_id', 'title',
        'message', 'type', 'is_read', 'read_at',
    ];

    protected $casts = [
        'is_read'  => 'boolean',
        'read_at'  => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitRequest()
    {
        return $this->belongsTo(VisitRequest::class);
    }
}