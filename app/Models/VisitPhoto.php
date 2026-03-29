<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitPhoto extends Model
{
    protected $fillable = ['visit_id', 'photo_path', 'original_name'];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
