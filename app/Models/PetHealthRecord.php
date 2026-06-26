<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetHealthRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'condition',
        'diagnosed_date',
        'medication',
        'dosage',
        'status',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'diagnosed_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active'     => '<span style="background:#fee2e2;color:#991b1b;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Active</span>',
            'resolved'   => '<span style="background:#d1fae5;color:#065f46;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Resolved</span>',
            'monitoring' => '<span style="background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;">Monitoring</span>',
            default      => $this->status,
        };
    }
}