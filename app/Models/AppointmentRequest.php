<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id',
        'requested_date',
        'requested_time',
        'service_type',
        'preferred_notes',
        'status',
        'approved_by',
        'rejection_reason',
        'approved_at',
    ];

    protected $casts = [
        'requested_date' => 'date',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user (customer) who made the request
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the patient (pet) for this request
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the staff member who approved this request
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
