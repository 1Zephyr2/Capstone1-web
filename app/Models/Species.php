<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $fillable = [
        'name',
        'characteristics',
        'description',
    ];

    protected $casts = [
        'characteristics' => 'json',
    ];

    // Relationships
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
