<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_date',
        'visit_time',
        'service_type',
        'chief_complaint',
        'notes',
        'health_worker',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function vitalSigns()
    {
        return $this->hasOne(VitalSign::class);
    }

    public function referral()
    {
        return $this->hasOne(Referral::class);
    }

    // Auto-fill today's date on creation (Smart Default)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($visit) {
            if (empty($visit->visit_date)) {
                $visit->visit_date = now()->toDateString();
            }
            if (empty($visit->visit_time)) {
                $visit->visit_time = now()->toTimeString();
            }
        });
    }

    // Scope for today's visits
    public function scopeToday($query)
    {
        return $query->whereDate('visit_date', today());
    }
}
