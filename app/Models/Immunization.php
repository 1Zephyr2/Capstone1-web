<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Immunization extends Model
{
    protected $fillable = [
        'patient_id',
        'vaccine_name',
        'dose_number',
        'date_given',
        'next_dose_due',
        'batch_number',
        'administered_by',
        'remarks',
    ];

    protected $casts = [
        'date_given' => 'date',
        'next_dose_due' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Check if vaccine is overdue
    public function getIsOverdueAttribute()
    {
        if (!$this->next_dose_due) return false;
        return Carbon::parse($this->next_dose_due)->isPast();
    }

    // Auto-calculate next dose due based on vaccine schedule
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($immunization) {
            if (empty($immunization->next_dose_due) && $immunization->dose_number) {
                $immunization->next_dose_due = self::calculateNextDose(
                    $immunization->vaccine_name,
                    $immunization->dose_number,
                    $immunization->date_given
                );
            }
        });
    }

    // Vaccine schedule based on DOH guidelines
    private static function calculateNextDose($vaccine, $dose, $dateGiven)
    {
        $date = Carbon::parse($dateGiven);
        
        $schedules = [
            'BCG' => [1 => null], // Single dose
            'Hepatitis B' => [1 => 4, 2 => 8], // weeks
            'Pentavalent' => [1 => 4, 2 => 4, 3 => null], // 4 weeks apart
            'OPV' => [1 => 4, 2 => 4, 3 => null],
            'PCV' => [1 => 4, 2 => 4, 3 => null],
            'MMR' => [1 => 52, 2 => null], // 1 year later
        ];

        $vaccineKey = strtoupper(str_replace(' ', '', $vaccine));
        
        foreach ($schedules as $key => $schedule) {
            if (stripos($vaccineKey, $key) !== false) {
                if (isset($schedule[$dose]) && $schedule[$dose]) {
                    return $date->addWeeks($schedule[$dose]);
                }
            }
        }

        return null;
    }

    // Scope for overdue vaccines
    public function scopeOverdue($query)
    {
        return $query->whereNotNull('next_dose_due')
                     ->where('next_dose_due', '<', now());
    }
}
