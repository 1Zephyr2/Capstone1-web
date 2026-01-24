<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Patient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'sex',
        'contact_number',
        'address',
        'philhealth_number',
        'emergency_contact_name',
        'emergency_contact_number',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    // Relationships
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function immunizations()
    {
        return $this->hasMany(Immunization::class);
    }

    public function prenatalRecords()
    {
        return $this->hasMany(PrenatalRecord::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    // Auto-calculate age from birthdate (Smart Default)
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthdate)->age;
    }

    // Full name for easy display
    public function getFullNameAttribute()
    {
        $middle = $this->middle_name ? ' ' . substr($this->middle_name, 0, 1) . '.' : '';
        return $this->first_name . $middle . ' ' . $this->last_name;
    }

    // Get last visit for "copy from last visit" feature
    public function getLastVisitAttribute()
    {
        return $this->visits()->latest('visit_date')->first();
    }

    // Get last vital signs for auto-fill
    public function getLastVitalSignsAttribute()
    {
        $lastVisit = $this->lastVisit;
        return $lastVisit ? $lastVisit->vitalSigns : null;
    }

    // Search scope for type-ahead search
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('first_name', 'like', "%{$term}%")
              ->orWhere('last_name', 'like', "%{$term}%")
              ->orWhere('patient_id', 'like', "%{$term}%")
              ->orWhere('contact_number', 'like', "%{$term}%");
        });
    }

    // Auto-generate patient ID on creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            if (empty($patient->patient_id)) {
                $year = date('Y');
                $lastPatient = static::whereYear('created_at', $year)
                    ->orderBy('id', 'desc')
                    ->first();
                
                $number = $lastPatient ? intval(substr($lastPatient->patient_id, -4)) + 1 : 1;
                $patient->patient_id = 'BHC-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}
