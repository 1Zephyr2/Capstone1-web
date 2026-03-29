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
        'coat_condition',
        'behavior',
        'grooming_notes',
        'flea_tick_product',
        'flea_tick_area',
        'nail_condition_before',
        'nail_condition_after',
        'dental_notes',
        'shedding_amount',
        'hair_removed',
        'boarding_observations',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function photos()
    {
        return $this->hasMany(VisitPhoto::class);
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
