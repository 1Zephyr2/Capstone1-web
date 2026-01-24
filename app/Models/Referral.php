<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_id',
        'referral_date',
        'referred_to',
        'reason',
        'urgency',
        'completed',
        'follow_up_date',
        'outcome',
    ];

    protected $casts = [
        'referral_date' => 'date',
        'follow_up_date' => 'date',
        'completed' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    // Auto-fill referral date
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($referral) {
            if (empty($referral->referral_date)) {
                $referral->referral_date = now()->toDateString();
            }
        });
    }

    // Scope for pending referrals
    public function scopePending($query)
    {
        return $query->where('completed', false);
    }
}
