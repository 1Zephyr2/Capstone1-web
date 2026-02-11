<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'appointment_date',
        'appointment_time',
        'service_type',
        'chief_complaint',
        'health_worker',
        'notes',
        'status',
        'vaccine_name',
        'dose_number',
        'gestational_age',
        'presentation',
        'fp_method',
        'referred_to',
        'referral_urgency',
        'google_event_id',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    /**
     * Get the patient that owns the appointment
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get formatted appointment date and time
     */
    public function getFormattedDateTimeAttribute(): string
    {
        return $this->appointment_date->format('Y-m-d') . ' ' . $this->appointment_time;
    }

    /**
     * Get formatted time for display
     */
    public function getFormattedTimeAttribute(): string
    {
        return \Carbon\Carbon::parse($this->appointment_time)->format('g:i A');
    }
}
