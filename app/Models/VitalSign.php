<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VitalSign extends Model
{
    protected $fillable = [
        'visit_id',
        'blood_pressure',
        'temperature',
        'pulse_rate',
        'weight',
        'height',
    ];

    protected $casts = [
        'temperature' => 'decimal:1',
        'pulse_rate' => 'decimal:1',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    // Visual indicators for normal ranges
    public function getTemperatureStatusAttribute()
    {
        if (!$this->temperature) return null;
        if ($this->temperature >= 36.1 && $this->temperature <= 37.2) return 'normal';
        if ($this->temperature > 37.2) return 'high';
        return 'low';
    }

    public function getPulseRateStatusAttribute()
    {
        if (!$this->pulse_rate) return null;
        if ($this->pulse_rate >= 60 && $this->pulse_rate <= 100) return 'normal';
        if ($this->pulse_rate > 100) return 'high';
        return 'low';
    }

    public function getBloodPressureStatusAttribute()
    {
        if (!$this->blood_pressure) return null;
        if (preg_match('/(\d+)\/(\d+)/', $this->blood_pressure, $matches)) {
            $systolic = (int)$matches[1];
            $diastolic = (int)$matches[2];
            
            if ($systolic < 120 && $diastolic < 80) return 'normal';
            if ($systolic >= 140 || $diastolic >= 90) return 'high';
            return 'elevated';
        }
        return null;
    }

    // Auto-calculate BMI
    public function getBmiAttribute()
    {
        if ($this->weight && $this->height) {
            $heightInMeters = $this->height / 100;
            return round($this->weight / ($heightInMeters * $heightInMeters), 1);
        }
        return null;
    }
}
