<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrenatalRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'lmp',
        'edd',
        'visit_date',
        'gestational_age_weeks',
        'weight',
        'blood_pressure',
        'fundal_height',
        'fetal_heart_tone',
        'risk_factors',
        'referred',
        'notes',
    ];

    protected $casts = [
        'lmp' => 'date',
        'edd' => 'date',
        'visit_date' => 'date',
        'weight' => 'decimal:2',
        'fundal_height' => 'decimal:1',
        'referred' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Auto-calculate EDD and gestational age from LMP
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($record) {
            if ($record->lmp) {
                // Auto-calculate EDD (LMP + 280 days)
                if (empty($record->edd)) {
                    $record->edd = Carbon::parse($record->lmp)->addDays(280);
                }
                
                // Auto-calculate gestational age
                if ($record->visit_date) {
                    $lmp = Carbon::parse($record->lmp);
                    $visitDate = Carbon::parse($record->visit_date);
                    $record->gestational_age_weeks = $lmp->diffInWeeks($visitDate);
                }
            }
        });
    }

    // Check for high-risk indicators
    public function getIsHighRiskAttribute()
    {
        if ($this->risk_factors) return true;
        
        // Check BP
        if ($this->blood_pressure && preg_match('/(\d+)\/(\d+)/', $this->blood_pressure, $matches)) {
            $systolic = (int)$matches[1];
            if ($systolic >= 140) return true;
        }
        
        return false;
    }
}
