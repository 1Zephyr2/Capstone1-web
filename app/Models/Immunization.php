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

    // Vaccine schedule based on veterinary guidelines
    private static function calculateNextDose($vaccine, $dose, $dateGiven)
    {
        $date = Carbon::parse($dateGiven);
        
        $schedules = [
            'Rabies' => [1 => 52, 2 => null], // Annual booster
            'DHPP' => [1 => 3, 2 => 3, 3 => 52], // Distemper, Hepatitis, Parvovirus, Parainfluenza
            'Bordetella' => [1 => 26, 2 => 52], // Kennel cough - 6 months then annual
            'Leptospirosis' => [1 => 4, 2 => 52], // 4 weeks then annual
            'Feline Leukemia' => [1 => 3, 2 => 52], // 3-4 weeks then annual
            'FVRCP' => [1 => 3, 2 => 3, 3 => 52], // Feline viral rhinotracheitis, calicivirus, panleukopenia
            'Canine Influenza' => [1 => 3, 2 => 52], // 3-4 weeks then annual
        ];

        $vaccineKey = strtoupper(str_replace(' ', '', $vaccine));
        
        foreach ($schedules as $key => $schedule) {
            if (stripos($vaccineKey, strtoupper(str_replace(' ', '', $key))) !== false) {
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
