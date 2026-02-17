<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BreedingRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'breeding_date',
        'sire',
        'dam',
        'heat_cycle_date',
        'pregnancy_confirmed_date',
        'expected_delivery_date',
        'litter_size',
        'breeding_status',
        'checkup_date',
        'weight',
        'risk_factors',
        'referred',
        'notes',
    ];

    protected $casts = [
        'breeding_date' => 'date',
        'heat_cycle_date' => 'date',
        'pregnancy_confirmed_date' => 'date',
        'expected_delivery_date' => 'date',
        'checkup_date' => 'date',
        'weight' => 'decimal:2',
        'referred' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Auto-calculate expected delivery date based on species and breeding date
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($record) {
            if ($record->breeding_date && empty($record->expected_delivery_date)) {
                $breedingDate = Carbon::parse($record->breeding_date);
                
                // Get gestation period based on species
                $patient = Patient::find($record->patient_id);
                if ($patient) {
                    $gestationDays = self::getGestationPeriod($patient->species);
                    $record->expected_delivery_date = $breedingDate->addDays($gestationDays);
                }
            }
        });
    }

    // Get typical gestation period for different species (in days)
    private static function getGestationPeriod($species)
    {
        $periods = [
            'Dog' => 63,
            'Cat' => 65,
            'Rabbit' => 31,
            'Guinea Pig' => 68,
            'Hamster' => 16,
            'Horse' => 340,
            'Cattle' => 283,
            'Goat' => 150,
            'Sheep' => 147,
        ];

        return $periods[$species] ?? 63; // Default to dog gestation
    }

    // Check if breeding is overdue
    public function getIsOverdueAttribute()
    {
        if (!$this->expected_delivery_date) return false;
        
        $today = Carbon::today();
        $expectedDate = Carbon::parse($this->expected_delivery_date);
        
        // Consider overdue if past expected date
        return $today->greaterThan($expectedDate);
    }

    // Get days until delivery
    public function getDaysUntilDeliveryAttribute()
    {
        if (!$this->expected_delivery_date) return null;
        
        $today = Carbon::today();
        $expectedDate = Carbon::parse($this->expected_delivery_date);
        
        return $today->diffInDays($expectedDate, false);
    }

    // Check for high-risk indicators
    public function getIsHighRiskAttribute()
    {
        if ($this->risk_factors) return true;
        
        // Could add more sophisticated risk assessment based on:
        // - Age of dam
        // - Previous breeding complications
        // - Breed-specific risks
        
        return false;
    }
}
